<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use ArrayObject;
/**
 * Animal Model
 *
 * @method \App\Model\Entity\Animal newEmptyEntity()
 * @method \App\Model\Entity\Animal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Animal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Animal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Animal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Animal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Animal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Animal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Animal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Animal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Animal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Animal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Animal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AnimalTable extends Table
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

        $this->setTable('animal');
        $this->setDisplayField(['name','specie','race']);
        $this->setPrimaryKey('id');

        $this->hasOne('AnimalShelter', ['dependent' => true]);

    }

    //Capitalize race
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['race'])) {
            $data['race'] = ucwords($data["race"]);
        }
        if (isset($data['name'])) {
            $data['name'] = ucwords($data["name"]);
        }
        if (isset($data['information'])) {
            $data['information'] = ucfirst($data["information"]);
        }
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

            ->requirePresence('name', 'create',__('El campo nombre es requerido.'))
            ->notEmptyString('name',__('El nombre del animal no puede ser vac??o.'))
            ->add('name',
                ['regex'=>[
                    'rule' =>['custom','/^[\w??????-????-??\s]*$/i'],
                    'message' => __('Introduce un nombre con caracteres alfab??ticos y espacios.')
                ]])
            ->add('name',
                ['minLength'=>[
                    'rule' =>['minLength',3],
                    'message' => __('El nombre debe tener m??nimo 3 caracteres.')
                ]])
            ->add('name',
                ['maxLength'=>[
                    'rule' =>['maxLength',30],
                    'message' => __('El nombre debe tener m??ximo 30 caracteres.'),
                    ''
                ]]);

        $validator
            ->allowEmptyFile('image',__('La imagen puede ser vac??a.'));

        $validator
            ->requirePresence('specie', 'create',__('El campo especie es requerido.'))
            ->notEmptyString('specie',__('La especie no puede ser vac??a.'))
            ->add('specie',
                ['inList'=>[
                    'rule' =>['inList',['cat','dog','bunny','hamster','snake','turtles','other']],
                    'message' => __('La especie debe ser una de las existentes.')
                ]]);

        $validator
            ->allowEmptyString('chip',__('El chip puede ser vac??o.'))
            ->add('chip',
                ['inList'=>[
                    'rule' =>['inList',['yes','no', 'unknown']],
                    'message' => __('Chip debe ser s??, no o desconocido.')
                ]]);

        $validator
            ->requirePresence('sex', 'create',__('El campo sexo es requerido.'))
            ->notEmptyString('sex',__('El sexo no puede ser vac??o.'))
            ->add('sex',
                ['inList'=>[
                    'rule' =>['inList',['intact_female','intact_male','neutered_female','castrated_male','unknow']],
                    'message' => __('El sexo debe ser de uno de los valores existentes.')
                ]]);


        $validator
            ->requirePresence('race', 'create',__('El campo raza es requerido.'))
            ->allowEmptyString('race', __('La raza pude ser vac??a.'))
            ->add('race',
                ['regex'=>[
                    'rule' =>['custom','/^[\w??????-????-??\s]*$/i'],
                    'message' => __('Introduce una raza con caracteres alfab??ticos y espacios.')
                ]])
            ->add('race',
                ['maxLength'=>[
                    'rule' =>['maxLength',100],
                    'message' => __('La raza debe tener m??ximo 100 caracteres.')
                ]]);

        $validator
            ->integer('age',__('La edad debe ser un n??mero.'))
            ->allowEmptyString('age',__('La edad puede ser vac??a.'))
            ->add('age', 'custom',
            ['rule'=> function($value, $context){
                if($value > 30){
                    return false;
                }
                return true;
            },
            'message' => __('La edad m??xima es 30 a??os.')
        ]);
        $validator
            ->allowEmptyString('information',__('La raza puede ser vac??a.')) 
            ->add('information',
            ['regex'=>[
                'rule' =>['custom','/^[\w??????-????-??\s.??,-]*$/i'],
                'message' => __('La informaci??n debe contener solo caracteres alfab??ticos, espacios y algunos s??mbolos [. , ?? ].')
            ]])
            ->add('information',
                ['maxLength'=>[
                    'rule' =>['maxLength',300],
                    'message' => __('La informaci??n debe tener m??ximo 300 caracteres.')
                ]]);

        $validator
            ->requirePresence('state', 'create', __('El campo estado es requerido.'))
            ->notEmptyString('state', 'El estado no puede ser vac??o.')
            ->add('state',
            ['inList'=>[
                'rule' =>['inList',['healthy','sick','adopted','dead','foster','vet','unknown','other']],
                'message' => __('El estado debe ser de uno de los valores existentes.')
            ]]);
            

        return $validator;
    }
}
