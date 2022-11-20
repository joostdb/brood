<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientsaddresses Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Clientsaddress newEmptyEntity()
 * @method \App\Model\Entity\Clientsaddress newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clientsaddress[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientsaddress get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clientsaddress findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clientsaddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clientsaddress[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientsaddress|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientsaddress saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clientsaddress[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientsaddress[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientsaddress[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clientsaddress[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientsaddressesTable extends Table
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

        $this->setTable('clientsaddresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->notEmptyString('user_id');

        $validator
            ->scalar('street')
            ->maxLength('street', 250)
            ->allowEmptyString('street');

        $validator
            ->scalar('number')
            ->maxLength('number', 250)
            ->allowEmptyString('number');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 250)
            ->allowEmptyString('zip');

        $validator
            ->scalar('city')
            ->maxLength('city', 250)
            ->allowEmptyString('city');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 250)
            ->allowEmptyString('telephone');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
