<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Update Entity.
 *
 * @property int $id
 * @property int $ticket_id
 * @property \App\Model\Entity\Ticket $ticket
 * @property string $update_text
 * @property \Cake\I18n\Time $created
 * @property int $analyst_id
 * @property \App\Model\Entity\Analyst $analyst
 * @property int $time_booking
 */
class Update extends Entity
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
