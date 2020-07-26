<?php

namespace App\Middlewares;

use App\Interfaces\Request as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class CSRF
{
    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next) :Response
    {
        return csrf()->__invoke($request, $response, $next);
    }
}