<?php
namespace App\Model\Table;

use App\Model\Entity\Analyst;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Analysts Model
 *
 * @property \Cake\ORM\Association\HasMany $Tickets
 * @property \Cake\ORM\Association\HasMany $Updates
 */
class AnalystsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('analysts');
        $this->displayField('username');
        $this->primaryKey('id');

        $this->hasMany('Tickets', [
            'foreignKey' => 'analyst_id'
        ]);
        $this->hasMany('Updates', [
            'foreignKey' => 'analyst_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('firstname');

        $validator
            ->allowEmpty('lastname');

        $validator
            ->allowEmpty('role');

        $validator
            ->allowEmpty('supportteam');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        return $rules;
    }
}
