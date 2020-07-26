<?php

namespace App\Services;

use App\Interfaces\Services;

class FlashService implements Services
{
    /**
     * @return mixed|\Slim\Flash\Messages
     */
    public static function boot()
    {
        return new \Slim\Flash\Messages();
    }
}