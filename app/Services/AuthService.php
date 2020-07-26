<?php

namespace App\Services;

use App\Models\User;
use App\Facades\Session;
use App\Entities\UserEntity;
use App\Interfaces\Services;
use App\Factories\UserFactory;

class AuthService implements Services
{
    /**
     * @var array
     */
    protected $errors;

    /**
     * @return AuthService|mixed
     */
    public static function boot() :AuthService
    {
        return new self();
    }

    /**
     * @return UserEntity
     */
    public function guest() :UserEntity
    {
        return UserFactory::build(['id' => 0]);
    }

    /**
     * @return UserEntity
     */
    public function user() :UserEntity
    {
        $userEntity = unserialize(Session::get('user.entity'));

        if (empty($userEntity)) {
            $userEntity = $this->guest();
        }

        return $userEntity;
    }

    /**
     * @param UserEntity $user
     * @return void
     */
    public function setUserSession(UserEntity $user) :void
    {
        Session::set('user.entity', serialize($user));
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password) :bool
    {
        $user = User::find([
            'email' => $email,
        ]);

        if (!$user->id()) {
            $this->errors[] = 'Credentials do not match our records!';
            return false;
        }

        if (password_verify($password, $user->password())) {
            $this->setUserSession($user);
            return true;
        }
        else {
            $this->errors[] = 'Wrong password given!';
        }

        return false;
    }

    /**
     * @return bool
     */
    public function logout() :bool
    {
        Session::unset();

        return true;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}