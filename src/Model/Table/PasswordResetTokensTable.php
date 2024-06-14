<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PasswordResetTokens Model
 *
 * @method \App\Model\Entity\PasswordResetToken newEmptyEntity()
 * @method \App\Model\Entity\PasswordResetToken newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PasswordResetToken> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PasswordResetToken get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PasswordResetToken findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PasswordResetToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PasswordResetToken> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PasswordResetToken|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PasswordResetToken saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PasswordResetToken>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PasswordResetToken>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PasswordResetToken>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PasswordResetToken> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PasswordResetToken>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PasswordResetToken>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PasswordResetToken>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PasswordResetToken> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PasswordResetTokensTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('password_reset_tokens');
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
            ->scalar('token')
            ->maxLength('token', 191)
            ->allowEmptyString('token')
            ->add('token', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('exp_date')
            ->allowEmptyDateTime('exp_date');

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
        $rules->add($rules->isUnique(['token'], ['allowMultipleNulls' => true]), ['errorField' => 'token']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
