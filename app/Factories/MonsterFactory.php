<?php

namespace App\Factories;

use App\Entities\MonsterEntity;

class MonsterFactory extends EntityFactory
{
    /**
     * @var string
     */
    protected static $entity = MonsterEntity::class;

    /**
     * @param null $entity
     * @return MonsterEntity
     */
    public static function bootEntity($entity = null) :MonsterEntity
    {
        return parent::bootEntity($entity);
    }

    /**
     * @param array $data
     * @param null $monsterEntity
     * @return MonsterEntity
     */
    public static function build($data = array(), $monsterEntity = null) :MonsterEntity
    {
        $data = parent::build($data);
        $monster = self::bootEntity($monsterEntity);

        if (isset($data['id'])) {
            $monster->setId($data['id']);
        }

        if (isset($data['name'])) {
            $monster->setName($data['name']);
        }

        if (isset($data['type'])) {
            $monster->setType($data['type']);
        }

        if (isset($data['level'])) {
            $monster->setLevel($data['level']);
        }

        if (isset($data['created_by'])) {
            $monster->setCreatedBy($data['created_by']);
        }

        if (isset($data['created_at'])) {
            $monster->setCreatedAt($data['created_at']);
        }

        if (isset($data['updated_by'])) {
            $monster->setUpdatedBy($data['updated_by']);
        }

        if (isset($data['updated_at'])) {
            $monster->setUpdatedAt($data['updated_at']);
        }

        return $monster;
    }
}