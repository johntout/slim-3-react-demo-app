<?php

namespace App\Services;

use App\Facades\Container;
use Illuminate\Support\Arr;
use App\Interfaces\Services;

class SessionService implements Services
{
    /**
     * @var null|SessionService
     */
    private static $instance = NULL;

    /**
     * @return \Slim\Flash\Messages
     */
    public function flash()
    {
        return Container::get('flash');
    }

    /**
     * @return mixed|void
     */
    public static function boot() :SessionService
    {
        if(self::$instance == NULL) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $key
     * @return mixed|string
     */
    public function get(string $key)
    {
        $value = Arr::get($_SESSION, $key);

        return $value;
    }

    /**
     * @param $key
     * @param $value
     * @return bool|void
     */
    public function set($key, $value)
    {
        if (empty($key)) {
            return false;
        }

        Arr::set($_SESSION, $key, $value);
    }

    /**
     * @param string $key
     */
    public function unset(string $key = '*')
    {
        if ($key == '*') {
            $this->destroy();
        }
        else {
            Arr::forget($_SESSION, $key);
        }
    }

    public function destroy()
    {
        session_destroy();
    }
}