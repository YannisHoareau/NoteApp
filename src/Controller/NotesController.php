<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Notes->find()->contain(['Users', 'Colors']);
        $notes = $this->paginate($query);

        $this->set(compact('notes'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function showPersonal()
    {
        $query = $this->Notes->findByUserId($this->request->getAttribute('identity')['id'])->contain(['Users', 'Colors']);
        $notes = $this->paginate($query);

        $this->set(compact('notes'));
        $this->render('index');
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $note = $this->Notes->findBySlug($slug)->contain(['Users', 'Colors', 'Tags'])->firstOrFail();
        $this->set(compact('note'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEmptyEntity();
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $colors = $this->Notes->Colors->find('list', limit: 200)->all();
        $tags = $this->Notes->Tags->find('list', limit: 200)->all();
        $this->set(compact('note', 'colors', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $slug Note slug.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $note = $this->Notes->findBySlug($slug)->contain(['Users', 'Colors', 'Tags'])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $colors = $this->Notes->Colors->find('list', limit: 200)->all();
        $this->set(compact('note', 'colors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function tags(...$tags)
    {
        $notes = $this->Notes->find('tagged', tags: $tags)
            ->all();

        $this->set([
            'notes' => $notes,
            'tags' => $tags
        ]);
    }
}
