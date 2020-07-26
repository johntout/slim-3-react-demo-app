<?php

namespace App\Facades;

/**
 * @method static \OAuth2\Storage\Pdo getStorage()
 * @method static \OAuth2\Server getServer()
 */

class OAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'oauth';
    }
}