<?php

namespace App\Providers;

use Pimple\Container;
use App\Services\OAuthService;

class OAuthServiceProvider extends ServiceProvider
{
    /**
     * @param Container $container
     * @return mixed|void
     */
    public function register(Container $container)
    {
        $container['oauth'] = function () {
           return OAuthService::boot();
        };
    }
}