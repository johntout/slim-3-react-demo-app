<?php

namespace App\Controllers\Api;

use App\Helpers\App;
use App\Models\Monster;
use App\Resources\MonsterResource;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MonstersController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) :Response
    {
        $route = $request->getAttribute('route');
        $level = App::sanitizeInput($route->getArgument('level'), 'INT');

        if (!empty($level)) {
            $monsters = Monster::all(['level' => $level]);
        }
        else {
            $monsters = Monster::all();
        }

        $monstersWithStats = [];
        foreach ($monsters as $monster) {
            $monstersWithStats[] = $monster->generateStats();
        }

        $resource = new MonsterResource($monstersWithStats);

        return $resource->toResponse();
    }
}