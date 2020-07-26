<?php

namespace App\Facades;

/**
 * @method static mixed get(string $id)
 * @method static mixed register(\Pimple\ServiceProviderInterface $provider, array $values = array())
 */

class Container extends Facade
{
    /**
     * @return \Slim\Container
     */
    public static function getInstance() :\Slim\Container
    {
        return self::self();
    }

    /**
     * @return \Slim\Container
     */
    public static function self() :\Slim\Container
    {
        return self::$app->getContainer();
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = self::self();

        return $instance->$method(...$args);
    }
}