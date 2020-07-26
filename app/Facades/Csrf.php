<?php

namespace App\Facades;

/**
 * @method static \App\Services\CsrfService self()
 * @method static string getTokenName()
 * @method static string getTokenValue()
 */

class Csrf extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'csrf';
    }
}