<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\SessionService;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     * @return mixed|void
     */
    public function register(Container $container)
    {
        $container['session'] = function () {
           return SessionService::boot();
        };
    }
}