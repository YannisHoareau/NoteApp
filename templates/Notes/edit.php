<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note $note
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $colors
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading"><?= $this->Html->link(__('List Notes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?></h3>
        </div>
    </aside>
    <div class="column column-80">
        <div class="notes form content">
            <?= $this->Form->create($note) ?>
            <fieldset>
                <legend><?= __('Edit Note') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                    echo $this->Form->control('color_id', ['options' => $colors]);
                    echo $this->Form->control('tag_string', ['type' => 'text']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
