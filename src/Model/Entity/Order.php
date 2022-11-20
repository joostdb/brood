<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $order_session
 * @property int $tour_id
 * @property int $user_id
 * @property int $item
 * @property int $quantity
 * @property int $price
 * @property string|null $notes
 * @property int $pay
 * @property string $review
 * @property \Cake\I18n\FrozenTime|null $date
 *
 * @property \App\Model\Entity\User $user
 */
class Order extends Entity
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
        'order_session' => true,
        'tour_id' => true,
        'user_id' => true,
        'itemorders' => true,
        'quantity' => true,
        'price' => true,
        'notes' => true,
        'pay' => true,
        'review' => true,
        'date' => true,
        'user' => true,
    ];
}
