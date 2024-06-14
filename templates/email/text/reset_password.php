<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \Cake\View\View $this
 * @var string $login
 * @var string $token
 */

echo 'You have been requiring a password reset for: '. $login . '.'. PHP_EOL;
echo 'Visit the link below to reset your password.' . PHP_EOL;
echo 'http://note-app.scopen-dev5/users/set-new-password/'. $token . PHP_EOL;
