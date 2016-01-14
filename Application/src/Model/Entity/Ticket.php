<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity.
 *
 * @property int $id
 * @property int $customer_id
 * @property \App\Model\Entity\Customer $customer
 * @property string $status
 * @property string $title
 * @property string $description
 * @property string $category
 * @property int $analyst_id
 * @property \App\Model\Entity\Analyst $analyst
 * @property \Cake\I18n\Time $created
 * @property string $ticket_type
 * @property \Cake\I18n\Time $resolution_date
 * @property int $total_time
 * @property \App\Model\Entity\Update[] $updates
 */
class Ticket extends Entity
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
