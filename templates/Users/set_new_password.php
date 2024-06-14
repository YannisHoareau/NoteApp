<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('password', ['required' => true, 'label' => __('Please enter your new password')]) ?>
    </fieldset>
    <div class="bottom-action-button">
        <?= $this->Form->submit(__('Send')); ?>
    </div>
    <?= $this->Form->end() ?>
</div>
