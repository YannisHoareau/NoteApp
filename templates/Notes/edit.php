<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note $note
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= $this->Html->link(__('List Notes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?></h4>
        </div>
    </aside>
    <div class="column column-80">
        <div class="notes form content">
            <?= $this->Form->create($note) ?>
            <fieldset>
                <legend><?= __('Edit Note') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['type' => 'text', 'readonly' => true, 'label' => __('Creator (Not changeable)'), 'value' => $note->user->login]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                ?>
            </fieldset>
            <div class="edit buttons">
                <?= $this->Form->button(__('Save')) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id), 'class' => 'button']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
