<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading"><?= $this->Html->link(__('List Colors'), ['action' => 'index'], ['class' => 'side-nav-item'])?></h3>
        </div>
    </aside>
    <div class="column column-80">
        <div class="colors form content">
            <?= $this->Form->create($color) ?>
            <fieldset>
                <legend><?= __('Edit Color') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('hexa_code');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
