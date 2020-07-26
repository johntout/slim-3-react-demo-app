<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\ViewService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     * @return mixed|void
     */
    public function register(Container $container)
    {
        $container['view'] = function () {
           return ViewService::boot();
        };
    }
}