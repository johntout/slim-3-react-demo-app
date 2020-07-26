<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\DatabaseService;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['db'] = function () {
            return DatabaseService::boot();
        };
    }
}