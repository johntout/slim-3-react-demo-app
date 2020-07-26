<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\RequestService;

class RequestServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     * @return mixed|void
     */
    public function register(Container $container)
    {
        RequestService::$container = $container;
        unset($container['request']);

        $container['request'] = function () {
            $request = RequestService::boot();
            return $request;
        };
    }
}