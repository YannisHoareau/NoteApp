<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note $note
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading"><?= $this->Html->link(__('List Notes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?></h3>
        </div>
    </aside>
    <div class="column column-80">
        <div class="notes view content">
            <h3><?= h($note->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($note->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $note->hasValue('user') ? $this->Html->link($note->user->login, ['controller' => 'Users', 'action' => 'view', $note->user->login]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= $note->hasValue('color') ? $this->Html->link($note->color->title, ['controller' => 'Colors', 'action' => 'view', $note->color->title]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($note->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($note->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($note->body)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Tags') ?></h4>
                <?= h($note->tag_string) ?>
            </div>
            <div>
                <?= $this->Html->link(__('Edit Note'), ['action' => 'edit', $note->slug], ['class' => 'button']) ?>
                <?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete note "{0}"?', $note->title), 'class' => 'button']) ?>
            </div>
        </div>
    </div>
</div>
