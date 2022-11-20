<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clientsaddress Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $street
 * @property string|null $number
 * @property string|null $zip
 * @property string|null $city
 * @property string|null $description
 * @property string|null $telephone
 * @property string|null $email
 *
 * @property \App\Model\Entity\User $user
 */
class Clientsaddress extends Entity
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
        'user_id' => true,
        'street' => true,
        'number' => true,
        'zip' => true,
        'city' => true,
        'description' => true,
        'telephone' => true,
        'email' => true,
        'user' => true,
    ];
}
