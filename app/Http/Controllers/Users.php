<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UsersCreateRequest;
use App\Http\Requests\Users\UsersLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    public function register(UsersCreateRequest $request)
    {
        $response = [
            'success' => false,
        ];
        $create = User::create($request->all());
        if ($create) {
            $response['success'] = true;
            $response['response'] = $create;
        }
        return response()->json($response);
    }

    public function login(UsersLoginRequest $request)
    {
        $response = [
            'success' => false,
        ];
        $data = $request->all();
        $user = User::where('username', $data['username'])->first();
        if (!empty($user) && Hash::check($data['password'], $user->password)) {
            $response['success'] = true;
            $response['response'] = $user;
        }
        return response()->json($response);
    }
}
