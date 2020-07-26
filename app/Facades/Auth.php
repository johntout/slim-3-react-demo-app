<?php

namespace App\Facades;

/**
 * @method static array getErrors()
 * @method static void logout
 * @method static bool blockedLogin()
 * @method static bool blockedTime()
 * @method static bool login(string $email, string $password)
 * @method static \App\Entities\UserEntity user()
 * @method static \App\Services\AuthService self()
 * @method static \App\Entities\UserEntity guest()
 * @method static void setUserSession(\App\Entities\UserEntity $user, array $options = array())
 */

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }
}