<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    public function register(UserCreateRequest $request)
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

    public function login(UserLoginRequest $request)
    {
        $response = [
            'success' => false,
        ];
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if (!empty($user) && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken($user->email);
            $response['success'] = true;
            $response['response'] = $user;
            $response['token'] = $token->plainTextToken;
        }
        return response()->json($response);
    }

    public function update(UserUpdateRequest $request)
    {
        $response = [
            'success' => false,
        ];
        $data = $request->all();
        $user = auth('sanctum')->user();
        $toUpdate = [];
        if (!empty($data['username'])) {
            $toUpdate['username'] = $data['username'];
        }
        if (!empty($data['email'])) {
            $toUpdate['email'] = $data['email'];
        }
        if (!empty($data['password'])) {
            $toUpdate['password'] = $data['password'];
        }
        $updated = User::where('id', $user->id)->update($toUpdate);
        if ($updated) {
            $response['success'] = true;
            $response['response'] = User::where('id', $user->id)->first();
        }
        return response()->json($response);
    }
}
