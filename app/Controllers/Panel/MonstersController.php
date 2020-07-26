<?php

namespace App\Controllers\Panel;

use App\Helpers\App;
use App\Models\Monster;
use App\Factories\MonsterFactory;
use App\Controllers\MasterController;
use App\Interfaces\Request as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MonstersController extends MasterController
{
    /**
     * Show Monsters list
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request) :Response
    {
        return view('monsters.list', $this->csrf($request))->render();
    }

    /**
     * Show Monster information
     *
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request) :Response
    {
        $id = App::sanitizeInput($request->getAttribute('id'), 'INT');
        $monster = Monster::findOrFail($id);
        $data = array_merge(['monster' => $monster], $this->csrf($request));

        return view('monsters.edit', $data)->render();
    }

    /**
     * Show monster creation form
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) :Response
    {
        return view('monsters.create', $this->csrf($request))->render();
    }

    /**
     * Update Monster
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request) :Response
    {
        $id = $request->inputs('id', 'INT');
        $user = Monster::findOrFail($id);

        $data = [
            'id' => $id,
            'name' => $request->inputs('name'),
            'type' => $request->inputs('type'),
            'level' => $request->inputs('level')
        ];

        $validateData = $this->validateData($data);
        if ($validateData === false) {
            return response()->withRedirect('/monsters/edit/'.$id, 301);
        }

        $user->process($data);
        $user->update();

        flash_message('success', 'Monster Updated!');

        return response()->withRedirect('/monsters/edit/'.$id, 301);
    }

    /**
     * Insert User
     *
     * @param Request $request
     * @return Response
     */
    public function insert(Request $request) :Response
    {
        $data = [
            'name' => $request->inputs('name'),
            'type' => $request->inputs('type'),
            'level' => $request->inputs('level')
        ];

        $validateData = $this->validateData($data);
        if ($validateData === false) {
            session()->set('monsters.create.name', $data['name']);
            session()->set('monsters.create.type', $data['type']);
            session()->set('monsters.create.level', $data['level']);

            return response()->withRedirect('/monsters/create', 301);
        }

        $user = MonsterFactory::build($data);
        $user->insert();
        session()->unset('monsters');

        flash_message('success', 'Monster Created!');

        return response()->withRedirect('/monsters', 301);
    }

    /**
     * Validate data
     *
     * @param array $data
     * @return bool
     */
    private function validateData(array $data) :bool
    {
        $success = true;

        if(empty($data['name'])) {
            flash_message('danger', 'Name is required!');
            $success = false;
        }

        if(empty($data['type'])) {
            flash_message('danger', 'Type is required!');
            $success = false;
        }

        if(empty($data['level'])) {
            flash_message('danger', 'Level is required!');
            $success = false;
        }

        if(!is_numeric($data['level'])) {
            flash_message('danger', 'Level must be a number!');
            $success = false;
        }

        return $success;
    }
}