<?php

if (!function_exists('db'))
{
    /**
     * @return \PDO
     */
    function db()
    {
        return app('db');
    }
}

if (!function_exists('view'))
{
    /**
     * @param string $template
     * @param array $attributes
     * @param int $status
     * @return \App\Services\ViewService
     */
    function view(string $template, array $attributes = [], $status = 200)
    {
        $view = app('view');

        if (func_num_args() === 0) {
            return $view;
        }
        else {
            return $view->make($template, $attributes, $status);
        }
    }
}

if (!function_exists('request'))
{
    /**
     * @return \App\Services\RequestService
     */
    function request()
    {
        return app('request');
    }
}

if (!function_exists('response'))
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    function response()
    {
        return app('response');
    }
}

if (!function_exists('app_dir'))
{
    /**
     * @return string
     */
    function app_dir()
    {
        return dirname(__DIR__);
    }
}

if (!function_exists('app'))
{
    /**
     * @param null $service
     * @return mixed|\Slim\Container
     */
    function app($service = null)
    {
        $container =  \App\Facades\Container::self();

        if (is_null($service)) {
            return $container;
        }
        else {
            return $container->get($service);
        }
    }
}

if (!function_exists('flash_message'))
{
    /**
     * @param string $type
     * @param string $message
     */
    function flash_message(string $type, string $message)
    {
        app('flash')->addMessage($type, $message);
    }
}

if (!function_exists('now'))
{
    /**
     * @return false|string
     */
    function now()
    {
        return date("Y-m-d H:i:s");
    }
}

if (!function_exists('csrf'))
{
    /**
     * @return \App\Services\CsrfService
     */
    function csrf()
    {
        return app('csrf');
    }
}

if (!function_exists('session'))
{
    /**
     * @return \App\Services\SessionService
     */
    function session()
    {
        return app('session');
    }
}

if (!function_exists('email'))
{
    /**
     * @return \App\Services\MailService
     */
    function email()
    {
        return app('mail');
    }
}

if (!function_exists('hash_string'))
{
    /**
     * @param string $string
     * @param string $algorithm
     * @return bool|string
     */
    function hash_string(string $string, $algorithm = PASSWORD_BCRYPT)
    {
        return password_hash($string, $algorithm);
    }
}

if (!function_exists('user'))
{
    /**
     * @return \App\Entities\UserEntity
     */
    function user()
    {
        return \App\Facades\Auth::user();
    }
}

if (!function_exists('app_dir'))
{
    /**
     * @return string
     */
    function app_dir()
    {
        return dirname(__DIR__);
    }
}