<?php
declare(strict_types=1);

namespace App\Controller;

use App\Mailer\UsersMailer;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * @param EventInterface $event
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'resetPassword', 'setNewPassword']);
    }

    /**
     * @return Response|void|null
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        if ($this->request->is('post') && !$this->isUserLogged()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    /**
     * @return Response|void|null
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * @return Response|false
     */
    public function isUserLogged()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'notes',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        return false;
    }

    /**
     * Allow a user to request a password reset.
     * @return
     */
    function resetPassword() {
        $this->isUserLogged();
        $this->checkTokensExpiration();
        if ($this->request->is('post')) {
            if (!$user = $this->Users->findByLogin($this->request->getData('login'))->first()) {
                $this->Flash->error(__('Sorry, the login entered was not found.'));
            } elseif ($this->userHasValidToken($user->id)) {
                $this->Flash->error(__('Sorry, we already sent you an email in the last 10 minutes.'));
            } else {
                $hash = $this->generateHashToken();
                $passwordsResetTokensTable = $this->fetchTable('PasswordResetTokens');
                $token = $passwordsResetTokensTable->newEmptyEntity();
                $token->user_id = $user->id;
                $token->token = $hash;
                $token->exp_date = date('Y-m-d H:i:s', strtotime('+10 minutes'));
                if ($passwordsResetTokensTable->save($token)) {
                    $newUserPasswordMailer = new UsersMailer();
                    $newUserPasswordMailer->send('resetPassword', [$user, $token->token]);
                }
            }
        }
    }

    /**
     * Allow a user to set a new password after reset request if valid token provided.
     * @return
     */
    function setNewPassword() {
        $this->isUserLogged();
        $this->checkTokensExpiration();
        $token = $this->request->getParam('pass')[0];
        $passwordsResetTokensTable = $this->fetchTable('PasswordResetTokens');
        if ($valid = $passwordsResetTokensTable->findByToken($token)->firstOrFail()) {
            if ($this->request->is('post')) {
                $user = $this->Users->findById($valid->user_id)->firstOrFail();
                $user->password = $this->request->getData('password');
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The password has been updated.'));
                    $passwordsResetTokensTable->delete($valid);

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The password could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('token'));
    }

    /**
     * Generate a unique token.
     * @return string User
     */
    function generateHashToken() {
        // Generate a random string 100 chars in length.
        $token = "";
        for ($i = 0; $i < 100; $i++) {
            $d = rand(1, 100000) % 2;
            $d ? $token .= chr(rand(33,79)) : $token .= chr(rand(80,126));
        }

        (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;

        // Generate hash of random string
        $hash = Security::hash($token, 'sha256', true);;
        for ($i = 0; $i < 20; $i++) {
            $hash = Security::hash($hash, 'sha256', true);
        }

        return $hash;
    }

    /**
     * check all tokens expiration date and delete if expired.
     */
    function checkTokensExpiration() {
        $passwordsResetTokensTable = $this->fetchTable('PasswordResetTokens');
        $tokens = $passwordsResetTokensTable->find('all')->all();
        foreach ($tokens as $token) {
            if ($token->exp_date->format('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime('now'))) {
                $passwordsResetTokensTable->delete($token);
            }
        }
    }

    /**
     * Check if the user already has a valid token within the previous 30 minutes.
     */
    function userHasValidToken($user_id) {
        $passwordsResetTokensTable = $this->fetchTable('PasswordResetTokens');
        if ($passwordsResetTokensTable->findByUserId($user_id)->first()) {
            return true;
        }
        return false;
    }

    /**
     * View method
     *
     * @param string|null $login User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $login = null)
    {
        $user = $this->Users->findByLogin($login)->contain(['Notes'])->firstOrFail();
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $login User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $login = null)
    {
        $user = $this->Users->findByLogin($login)->contain([])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
