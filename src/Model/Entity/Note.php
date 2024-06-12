<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Note Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $color_id
 * @property string $title
 * @property string $slug
 * @property string|null $body
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\ArticlesTag[] $articles_tags
 */
class Note extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'color_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'color' => true,
        'articles_tags' => true,
    ];
}
