<?php
/**
 * @var iterable<\App\Model\Entity\Tag> $tags
 * @var iterable<\App\Model\Entity\Note> $notes
 */
?>
<h1>
    Articles tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
    <?php foreach ($notes as $note): ?>
        <article>
            <h4><?= $this->Html->link(
                    $note->title,
                    ['controller' => 'Notes', 'action' => 'view', $note->slug]
                ) ?></h4>
            <span><?= h($note->created) ?></span>
        </article>
    <?php endforeach; ?>
</section>
