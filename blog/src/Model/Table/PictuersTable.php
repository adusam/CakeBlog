<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PictuersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('puctuers');
        $this->setDisplayField('data');
        $this->setPrimaryKey('id');

        $this->belongsTo('Articles',[
            'foreignKey' => 'pictuer_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;

    }
}
?>
