<?php

namespace App\Middlewares;

use App\Facades\Auth;
use App\Interfaces\Request as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class Authorization
{
    /*
     * @var array
     */
    protected $exceptions = [
        'login',
        'auth.login',
    ];

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next) :Response
    {
        $route = $request->getAttribute('route');

        if (Auth::user()->isGuest() && !in_array($route->getName(), $this->exceptions)) {
            return $response->withRedirect('/', 301);
        }

        return $next($request, $response);
    }
}