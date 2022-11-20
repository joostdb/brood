<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stock Entity
 *
 * @property int $id
 * @property string $item_id
 * @property string $user_id
 * @property string $quantity
 * @property \Cake\I18n\FrozenTime|null $date
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\User $user
 */
class Stock extends Entity
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
    protected $_accessible = [
        'item_id' => true,
        'user_id' => true,
        'tour_id' => true,
        'quantity' => true,
        'date' => true,
        'item' => true,
        'user' => true,
    ];
}
