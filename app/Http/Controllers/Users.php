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
        $created = User::create($request->all());
        if ($created) {
            $response['success'] = true;
            $response['response'] = $created;
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
            $token = $user->createToken($user->email);
            $response['success'] = true;
            $response['response'] = $user;
            $response['token'] = $token->plainTextToken;
        }
        return response()->json($response);
    }
}
