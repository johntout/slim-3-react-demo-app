<?php

namespace App\Controllers\Panel;

use App\Helpers\App;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Factories\UserFactory;
use App\Controllers\MasterController;
use App\Interfaces\Request as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UsersController extends MasterController
{
    /**
     * Show Users list
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) :Response
    {
        $users = User::all();

        return view('users.list', ['users' => $users])->render();
    }

    /**
     * Show User information
     *
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request) :Response
    {
        $id = App::sanitizeInput($request->getAttribute('id'), 'INT');
        $user = User::findOrFail($id);
        $data = array_merge(['user' => $user], $this->csrf($request));

        return view('users.edit', $data)->render();
    }

    /**
     * Show user creation form
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) :Response
    {
        return view('users.create', $this->csrf($request))->render();
    }

    /**
     * Update User
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request) :Response
    {
        $id = $request->inputs('id', 'INT');
        $user = User::findOrFail($id);

        $data = [
            'id' => $id,
            'email' => $request->inputs('email', 'EMAIL'),
            'name' => $request->inputs('name'),
            'last_name' => $request->inputs('last_name'),
        ];

        $password = $request->inputs('password');
        if (!empty($password)) {
            $data['password'] = $password;
            $data['confirm_password'] = $request->inputs('confirm_password');
        }

        $validateData = $this->validateData($data);
        if ($validateData === false) {
            return response()->withRedirect('/users/edit/'.$id, 301);
        }

        $user->process($data);
        $user->update();

        flash_message('success', 'User Updated!');

        return response()->withRedirect('/users/edit/'.$id, 301);
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
            'email' => $request->inputs('email', 'EMAIL'),
            'name' => $request->inputs('name'),
            'last_name' => $request->inputs('last_name'),
            'password' => $request->inputs('password'),
            'confirm_password' => $request->inputs('confirm_password'),
        ];

        $validateData = $this->validateData($data);
        if ($validateData === false) {
            session()->set('users.create.email', $data['email']);
            session()->set('users.create.name', $data['name']);
            session()->set('users.create.last_name', $data['last_name']);

            return response()->withRedirect('/users/create', 301);
        }

        $user = UserFactory::build($data);
        $user->insert();
        session()->unset('users');

        flash_message('success', 'User Created!');

        return response()->withRedirect('/users', 301);
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

        if(empty($data['last_name'])) {
            flash_message('danger', 'Last Name is required!');
            $success = false;
        }

        if(empty($data['email'])) {
            flash_message('danger', 'Email is required!');
            $success = false;
        }

        $existingUser = User::find(['email' => $data['email']]);
        if ($existingUser->id() && $existingUser->id() != Arr::get($data, 'id')) {
            flash_message('danger', 'Email already exists!');
            $success = false;
        }

        if(isset($data['password'])) {
            if (empty($data['password'])) {
                flash_message('danger', 'You have to enter a password!');
                $success = false;
            }

            if (empty($data['confirm_password'])) {
                flash_message('danger', 'You have to re-enter your password!');
                $success = false;
            }

            if (!empty($data['confirm_password']) && $data['password'] !== $data['confirm_password']) {
                flash_message('danger', 'Passwords do not match!');
                $success = false;
            }
        }

        return $success;
    }
}