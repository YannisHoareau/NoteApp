<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Color> $colors
 */
?>
<div class="colors index content">
    <?= $this->Html->link(__('New Color'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Colors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('hexa_code') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($colors as $color): ?>
                <tr>
                    <td><?= $this->Html->link(h($color->title), ['action' => 'view', $color->title]) ?></td>
                    <td><?= h($color->hexa_code) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $color->title]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $color->title], ['confirm' => __('Are you sure you want to delete color "{0}" ?', $color->title)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
