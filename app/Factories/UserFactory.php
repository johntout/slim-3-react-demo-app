<?php

namespace App\Factories;

use App\Entities\UserEntity;

class UserFactory extends EntityFactory
{
    /**
     * @var string
     */
    protected static $entity = UserEntity::class;

    /**
     * @param null $entity
     * @return UserEntity
     */
    public static function bootEntity($entity = null) :UserEntity
    {
        return parent::bootEntity($entity);
    }

    /**
     * @param array $data
     * @param null $userEntity
     * @return UserEntity
     */
    public static function build($data = array(), $userEntity = null) :UserEntity
    {
        $data = parent::build($data);
        $user = self::bootEntity($userEntity);

        if (isset($data['id'])) {
            $user->setId($data['id']);
        }

        if (isset($data['name'])) {
            $user->setName($data['name']);
        }

        if (isset($data['last_name'])) {
            $user->setLastName($data['last_name']);
        }

        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        if (isset($data['created_by'])) {
            $user->setCreatedBy($data['created_by']);
        }

        if (isset($data['created_at'])) {
            $user->setCreatedAt($data['created_at']);
        }

        if (isset($data['updated_by'])) {
            $user->setUpdatedBy($data['updated_by']);
        }

        if (isset($data['updated_at'])) {
            $user->setUpdatedAt($data['updated_at']);
        }

        return $user;
    }
}