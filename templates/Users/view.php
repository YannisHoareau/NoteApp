<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?></h4>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->login) ?></h3>
            <table>
                <tr>
                    <th><?= __('Login') ?></th>
                    <td><?= h($user->login) ?></td>
                </tr>
                <tr>
                    <th><?= __('Firstname') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h(date('d-m-Y', strtotime($user->created))) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h(date('d-m-Y', strtotime($user->modified))) ?></td>
                </tr>
            </table>
            <div class="edit buttons">
                <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->login], ['class' => 'button']) ?>
                <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete "{0}" user?', $user->login), 'class' => 'button']) ?>
            </div>
            <div class="related">
                <h4><?= __('Related Notes') ?></h4>
                <?php if (!empty($user->notes)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->notes as $note) : ?>
                        <tr>
                            <td><?= h($note->id) ?></td>
                            <td><?= h($note->user_id) ?></td>
                            <td><?= h($note->title) ?></td>
                            <td><?= h($note->slug) ?></td>
                            <td><?= h($note->body) ?></td>
                            <td><?= h($note->created) ?></td>
                            <td><?= h($note->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Notes', 'action' => 'view', $note->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Notes', 'action' => 'edit', $note->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notes', 'action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
