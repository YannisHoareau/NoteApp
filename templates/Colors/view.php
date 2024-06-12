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
        <div class="colors view content">
            <h3><?= h($color->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($color->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hexa Code') ?></th>
                    <td><?= h($color->hexa_code) ?></td>
                </tr>
            </table>
            <div class="edit buttons">
                <?= $this->Html->link(__('Edit Color'), ['action' => 'edit', $color->title], ['class' => 'button']) ?>
                <?= $this->Form->postLink(__('Delete Color'), ['action' => 'delete', $color->title], ['confirm' => __('Are you sure you want to delete color "{0}" ?', $color->title), 'class' => 'button']) ?>
            </div>
        </div>
    </div>
</div>
