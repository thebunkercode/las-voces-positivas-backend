<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UsersCreateRequest;
use App\Models\User;

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
}
