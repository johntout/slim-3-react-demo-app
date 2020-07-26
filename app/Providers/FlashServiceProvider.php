<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\FlashService;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['flash'] = function () {
            return FlashService::boot();
        };
    }
}