<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\CsrfService;

class CsrfServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['csrf'] = function () {
            return CsrfService::boot();
        };
    }
}