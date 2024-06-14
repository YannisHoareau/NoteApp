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
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Rao\'s Note-App';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Note-</span>App</a>
            <?php
                if ($user = $this->request->getAttribute('identity')) {
                    echo __('Logged in as: {0}', $this->request->getAttribute('identity')['login']);
                }
            ?>
        </div>
        <div class="top-nav-actions">
            <?php
                $this->loadHelper('Authentication.Identity');
                if ($this->Identity->isLoggedIn()) {
                    $action = 'logout';
                } else {
                    $action = 'login';
                }
                echo $this->Html->link(__($action), ['controller' => 'Users', 'action' => $action], ['class' => 'button']);
            ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?php if (!in_array($this->request->getParam('action'), ['login', 'resetPassword', 'setNewPassword'])): ?>
                <div class="row">
                    <div class="column column-10"><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></div>
                    <div class="column column-10"><?= $this->Html->link(__('Notes'), ['controller' => 'Notes', 'action' => 'index']) ?></div>
                    <div class="column column-10"><?= $this->Html->link(__('Colors'), ['controller' => 'Colors', 'action' => 'index']) ?></div>
                    <div class="column column-10"><?= $this->Html->link(__('Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></div>
                </div>
            <?php endif; ?>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
