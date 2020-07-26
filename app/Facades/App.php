<?php

namespace App\Facades;

/**
 * @method static mixed get(string $pattern, callable|string $callable)
 * @method static mixed post(string $pattern, callable|string $callable)
 * @method static mixed group(string $pattern, callable|string $callable)
 * @method static add(callable|string $callable)
 */

class App extends Facade
{
    /**
     * @return \Slim\App
     */
    public static function self() :\Slim\App
    {
        return self::$app;
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