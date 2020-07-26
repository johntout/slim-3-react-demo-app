<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     * @return mixed|void
     */
    public function register(Container $container)
    {
        $container['auth'] = function () {
           return AuthService::boot();
        };
    }
}