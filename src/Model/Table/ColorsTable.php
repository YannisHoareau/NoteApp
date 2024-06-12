<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Colors Model
 *
 * @property \App\Model\Table\NotesTable&\Cake\ORM\Association\HasMany $Notes
 *
 * @method \App\Model\Entity\Color newEmptyEntity()
 * @method \App\Model\Entity\Color newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Color> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Color get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Color findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Color patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Color> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Color|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Color saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Color>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Color>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Color>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Color> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Color>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Color>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Color>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Color> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ColorsTable extends Table
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

        $this->setTable('colors');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Notes', [
            'foreignKey' => 'color_id',
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
            ->scalar('title')
            ->maxLength('title', 191)
            ->allowEmptyString('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('hexa_code')
            ->maxLength('hexa_code', 7)
            ->allowEmptyString('hexa_code');

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
        $rules->add($rules->isUnique(['title'], ['allowMultipleNulls' => true]), ['errorField' => 'title']);

        return $rules;
    }
}
