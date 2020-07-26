<?php

namespace App\Facades;

/**
 * @method static mixed raw()
 * @method static \App\Services\ViewService self()
 * @method static \Psr\Http\Message\ResponseInterface render()
 * @method static \App\Services\ViewService make(string $template, array $attributes, int $status = 200)
 */

class View extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'view';
    }
}