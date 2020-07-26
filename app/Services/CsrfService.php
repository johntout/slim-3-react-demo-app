<?php

namespace App\Services;

use \Slim\Csrf\Guard;
use App\Interfaces\Services;

class CsrfService extends Guard implements Services
{
    /**
     * @var null
     */
    static private $__instance = NULL;

    /**
     * @return mixed|Guard|null
     */
    public static function boot()
    {
        if (self::$__instance == NULL) {
            $storage = null;

            self::$__instance = new Guard(
                'csrf',
                $storage,
                null,
                200,
                16,
                true
            );
        }

        return self::$__instance;
    }
}