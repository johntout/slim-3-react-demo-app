<?php

namespace App\Facades;

/**
 * @method static \App\Services\RequestService self()
 * @method static \App\Interfaces\Request withAttribute(string $name, $value)
 */

class Request extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'request';
    }
}