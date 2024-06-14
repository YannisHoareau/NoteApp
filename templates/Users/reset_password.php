<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your login') ?></legend>
        <?= $this->Form->control('login', ['required' => true]) ?>
    </fieldset>
    <div class="bottom-action-button">
        <?= $this->Form->submit(__('Send')); ?>
    </div>
    <?= $this->Form->end() ?>
</div>
