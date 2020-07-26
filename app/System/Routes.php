<?php

namespace App\System;

use App\Facades\App;
use App\Facades\OAuth;
use App\Middlewares\CSRF;
use App\Middlewares\Authorization;
use Chadicus\Slim\OAuth2\Routes as OAuthRoutes;
use Chadicus\Slim\OAuth2\Middleware as OAuthMiddleware;

final class Routes
{
    public static function register()
    {
        self::auth();

        self::panel();

        self::oauth();

        self::api();
    }

    private static function oauth()
    {
        App::group('/oauth', function() {
            App::post(OAuthRoutes\Token::ROUTE, new OAuthRoutes\Token(OAuth::getServer()))
                ->setName('token');
        });
    }

    private static function api()
    {
        App::group('/api', function() {
            App::get('/monsters[/{level}]', 'App\Controllers\Api\MonstersController:index')
                ->setName('api.monsters')->add(new OAuthMiddleware\Authorization(OAuth::getServer(), app()));
        });
    }

    private static function auth()
    {
        App::group('/', function() {
            App::post('login', '\App\Controllers\Auth\AuthController:login')
                ->setName('auth.login');

            App::get('logout', '\App\Controllers\Auth\AuthController:logout')
                ->setName('auth.logout');
        })->add(new CSRF)->add(new Authorization);
    }

    private static function panel()
    {
        App::group('/', function() {
            // Dashboard routes
            App::get('', '\App\Controllers\Panel\PanelController:login')
                ->setName('login');

            App::get('dashboard', '\App\Controllers\Panel\PanelController:dashboard')
                ->setName('dashboard');

            App::get('retrieve-token', '\App\Controllers\Panel\PanelController:getToken')
                ->setName('retrieve.token');

            // Users Routes
            App::group('users', function() {
                App::get('', '\App\Controllers\Panel\UsersController:index')
                    ->setName('users.list');

                App::get('/create', '\App\Controllers\Panel\UsersController:create')
                    ->setName('users.create');

                App::get('/edit/{id}', '\App\Controllers\Panel\UsersController:edit')
                    ->setName('users.edit');

                App::post('/update', '\App\Controllers\Panel\UsersController:update')
                    ->setName('users.update');

                App::post('/insert', '\App\Controllers\Panel\UsersController:insert')
                    ->setName('users.insert');
            });

            // Monsters Routes
            App::group('monsters', function() {
                App::get('', '\App\Controllers\Panel\MonstersController:index')
                    ->setName('monsters.list');

                App::get('/create', '\App\Controllers\Panel\MonstersController:create')
                    ->setName('monsters.create');

                App::get('/edit/{id}', '\App\Controllers\Panel\MonstersController:edit')
                    ->setName('monsters.edit');

                App::post('/update', '\App\Controllers\Panel\MonstersController:update')
                    ->setName('monsters.update');

                App::post('/insert', '\App\Controllers\Panel\MonstersController:insert')
                    ->setName('monsters.insert');
            });
        })->add(new CSRF)->add(new Authorization);
    }
}