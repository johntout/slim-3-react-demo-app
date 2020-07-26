<?php

namespace App\Factories;

class EntityFactory
{
    /**
     * @var string
     */
    protected static $entity;

    /**
     * @var array
     */
    protected static $data;

    /**
     * @param null $entity
     * @return null
     */
    public static function bootEntity($entity = null)
    {
        if (is_null($entity)) {
            $entity = new static::$entity(static::$data);
        }

        return $entity;
    }

    /**
     * @param array $data
     * @return array
     */
    public static function build($data = array())
    {
        static::$data = (array) $data;

        return static::$data;
    }
}