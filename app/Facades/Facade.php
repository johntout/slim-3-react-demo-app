<?php

namespace App\Facades;

use Slim\App;

class Facade
{
    /*
     * var Slim\App
     */
    public static $app;

    /*
     * var array
     */
    public static $resolvedInstances;

    /**
     * @param App $app
     */
    public static function setFacadeApplication(App $app)
    {
        Facade::$app = $app;
    }

    /**
     * @return mixed
     */
    public static function self()
    {
        return Facade::$app->getContainer()[static::getFacadeAccessor()];
    }

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return '';
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::resolveFacadeInstance(static::getFacadeAccessor());

        return $instance->$method(...$args);
    }

    /**
     * @param $instance
     */
    public static function swap($instance)
    {
        static::$resolvedInstances[static::getFacadeAccessor()] = $instance;

        if (isset(static::$app)) {
            unset(static::$app->getContainer()[static::getFacadeAccessor()]);
            static::$app->getContainer()[static::getFacadeAccessor()] = $instance;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if (isset(static::$resolvedInstances[$name])) {
            return static::$resolvedInstances[$name];
        }

        return static::$resolvedInstances[$name] = static::$app->getContainer()[$name];
    }
}