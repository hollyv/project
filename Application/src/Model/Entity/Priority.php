<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Priority Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $resolution_time
 * @property \App\Model\Entity\Ticket[] $tickets
 */
class Priority extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
