<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $ingredients
 * @property int $quantity
 * @property int $price
 * @property int $weight
 * @property string|null $photo
 * @property string|null $photo_dir
 * @property \Cake\I18n\FrozenTime $deadline
 * @property \Cake\I18n\FrozenTime|null $productiondate
 * @property \Cake\I18n\FrozenTime|null $distributiondate
 */
class Item extends Entity
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
        'name' => true,
        'description' => true,
        'ingredients' => true,
        'quantity' => true,
        'price' => true,
        'weight' => true,
        'photo' => true,
        'photo_dir' => true,
        'deadline' => true,
        'productiondate' => true,
        'distributiondate' => true,
    ];
}
