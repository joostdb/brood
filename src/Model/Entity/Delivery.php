<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Delivery Entity
 *
 * @property int $id
 * @property string $subject
 * @property string|null $text
 * @property string|null $items
 * @property \Cake\I18n\FrozenTime $deadline
 * @property \Cake\I18n\FrozenTime|null $distributiondate
 * @property \Cake\I18n\FrozenTime|null $date
 */
class Delivery extends Entity
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
        'subject' => true,
        'text' => true,
        'items' => true,
        'deadline' => true,
        'distributiondate' => true,
        'date' => true,
    ];
}
