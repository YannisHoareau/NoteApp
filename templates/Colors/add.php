<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $color
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Colors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="colors form content">
            <?= $this->Form->create($color) ?>
            <fieldset>
                <legend><?= __('Add Color') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('hexa_code');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
