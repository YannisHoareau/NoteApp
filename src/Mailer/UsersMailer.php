<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Users mailer.
 */
class UsersMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static string $name = 'Users';

    /**
     *  Send a mail with a token valid for 30 minutes
     *
     * @param $user
     * @param $token
     * @return void
     */
    public function resetPassword($user, $token)
    {
        $this
            ->setTo($user->email)
            ->setFrom('robot@scopen.fr')
            ->setSubject('Reset password')
            ->setViewVars(['token' => $token, 'login' => $user->login]);
    }
}
