<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tour Model
 *
 * @method \App\Model\Entity\Tour newEmptyEntity()
 * @method \App\Model\Entity\Tour newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tour get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tour findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tour[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tour|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tour saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tour[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tour[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tour[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tour[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TourTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tour');
        $this->setDisplayField('text');
        $this->setPrimaryKey('id');


        $this->hasMany('Itemorders', [
            'foreignKey' => 'tour_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');
        $validator
            ->integer('delivery_id')
            ->requirePresence('delivery_id', 'create')
            ->notEmptyString('delivery_id');

        $validator
            ->scalar('text')
            ->allowEmptyString('text');

        $validator
            ->scalar('clients')
            ->allowEmptyString('clients');

        $validator
            ->integer('pickup')
            ->requirePresence('pickup', 'create')
            ->allowEmptyString('pickup');

        $validator
            ->integer('volume')
            ->requirePresence('volume', 'create')
            ->notEmptyString('volume');

        $validator
            ->dateTime('distributiondate')
            ->allowEmptyDateTime('distributiondate');
        $validator
            ->dateTime('date')
            ->allowEmptyDateTime('date');

        return $validator;
    }
}
