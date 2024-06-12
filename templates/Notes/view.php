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
        <div class="notes view content">
            <h3><?= h($note->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $note->hasValue('user') ? $this->Html->link($note->user->login, ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($note->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h(date('d-m-Y H:i', strtotime($note->created))) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h(date('d-m-Y H:i', strtotime($note->modified))) ?></td>
                </tr>
            </table>
            <div class="edit buttons">
                <?= $this->Html->link(__('Edit Note'), ['action' => 'edit', $note->slug], ['class' => 'button']) ?>
                <?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id), 'class' => 'button']) ?>
            </div>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($note->body)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
