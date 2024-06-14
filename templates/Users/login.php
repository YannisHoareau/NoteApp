<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('login', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <div class="bottom-action-button">
        <?= $this->Form->submit(__('Login')); ?>
        <?= $this->Html->link(__('Sign up'), ['action' => 'add'], ['class'=> 'button']) ?>
        <?= $this->Html->link(__('Forgot password'), ['action' => 'resetPassword'], ['class'=> 'button']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
