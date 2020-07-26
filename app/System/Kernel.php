<?php

namespace App\System;

use Slim\App;
use Dotenv\Dotenv;
use App\Facades\Facade;
use App\Facades\Container;
use Slim\Container as SlimContainer;
use Psr\Http\Message\ResponseInterface as Response;

final class Kernel
{
    /**
     * @return Response
     * @throws \Throwable
     */
    public static function boot() :Response
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $container = new SlimContainer([
            'settings' => [
                'displayErrorDetails' => true,
                'determineRouteBeforeAppMiddleware' => true
            ]
        ]);

        $app = new App($container);
        Facade::setFacadeApplication($app);
        Dotenv::create(app_dir())->load();

        Kernel::registerServiceProviders();
        Routes::register();

        return $app->run();
    }

    public static function registerServiceProviders()
    {
        $serviceProviders = [
            \App\Providers\DatabaseServiceProvider::class,
            \App\Providers\SessionServiceProvider::class,
            \App\Providers\ViewServiceProvider::class,
            \App\Providers\CsrfServiceProvider::class,
            \App\Providers\FlashServiceProvider::class,
            \App\Providers\AuthServiceProvider::class,
            \App\Providers\RequestServiceProvider::class,
            \App\Providers\OAuthServiceProvider::class
        ];

        foreach ($serviceProviders as $serviceProvider) {
            Container::register(new $serviceProvider());
        }
    }
}