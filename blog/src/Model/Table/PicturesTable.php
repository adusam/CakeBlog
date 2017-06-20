<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pictures Model
 *
 * @property \Cake\ORM\Association\HasMany $Articles
 *
 * @method \App\Model\Entity\Picture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Picture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Picture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Picture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Picture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Picture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Picture findOrCreate($search, callable $callback = null, $options = [])
 */
class PicturesTable extends Table
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

        $this->setTable('pictures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Articles', [
            'foreignKey' => 'picture_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        return $validator;
    }
}
