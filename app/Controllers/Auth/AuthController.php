<?php

namespace App\Controllers\Auth;

use App\Facades\Auth;
use App\Interfaces\Request as Request;
use \Psr\Http\Message\ResponseInterface;

class AuthController
{
    /**
     * @var string
     */
    protected $redirect = '/dashboard';

    /**
     * @var string
     */
    protected $failedLoginRedirect = '/';

    /**
     * @param Request $request
     * @return ResponseInterface
     */
    public function login(Request $request) :ResponseInterface
    {
        $email = $request->inputs('email');
        $password = $request->inputs('password');

        if(Auth::login($email, $password)) {
            return response()->withRedirect($this->redirect, 301);
        }
        else {
            flash_message('danger', implode('<br>', Auth::getErrors()));

            return response()->withRedirect($this->failedLoginRedirect, 301);
        }
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     */
    public function logout(Request $request) :ResponseInterface
    {
        Auth::logout();

        return response()->withRedirect($this->redirect, 301);
    }
}