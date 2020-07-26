<?php

namespace App\Controllers\Panel;

use App\Facades\Auth;
use App\Traits\CommunicatesWithApi;
use App\Controllers\MasterController;
use App\Interfaces\Request as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PanelController extends MasterController
{
    use CommunicatesWithApi;

    /**
     * Show portal login form
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request) :Response
    {
        if (!Auth::user()->isGuest()) {
            return response()->withRedirect('/dashboard', 301);
        }

        return view('login', $this->csrf($request))->render();
    }

    /**
     * Show portal dashboard
     *
     * @return Response
     */
    public function dashboard() :Response
    {
        return view('dashboard')->render();
    }

    /**
     *  Retrieve Token
     *
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken() :Response
    {
        return response()->withJson($this->retrieveToken());
    }
}