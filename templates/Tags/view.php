<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading"><?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?></h3>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tags view content">
            <h3><?= h($tag->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($tag->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($tag->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($tag->modified) ?></td>
                </tr>
            </table>
            <div class="edit buttons">
                <?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->title], ['class' => 'button']) ?>
                <?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->title], ['confirm' => __('Are you sure you want to delete tag "{0}" ?', $tag->title), 'class' => 'button']) ?>
            </div>
        </div>
    </div>
</div>
