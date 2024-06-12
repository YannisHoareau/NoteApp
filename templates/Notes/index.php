<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Note> $notes
 */
?>
<div class="notes index content">
    <?= $this->Html->link(__('New Note'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Notes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('color_id') ?></th>
                    <th><?= $this->Paginator->sort('last modification') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                <tr>
                    <td><?= $this->Html->link(h($note->title), ['action' => 'view', $note->slug]) ?></td>
                    <td><?= $note->hasValue('user') ? $this->Html->link($note->user->login, ['controller' => 'Users', 'action' => 'view', $note->user->login]) : '' ?></td>
                    <td><?= $note->hasValue('color') ? $this->Html->link($note->color->title, ['controller' => 'Colors', 'action' => 'view', $note->color->title]) : '' ?></td>
                    <td><?= h($note->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $note->slug]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete note "{0}"?', $note->title)]) ?>
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
