<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth;

use Mgcodeur\LaravelApiAuthMaster\Http\Requests\Auth\AuthRegisterRequest;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster;

class AuthRegisterController
{
    public function __invoke(AuthRegisterRequest $request)
    {
        $user = LaravelApiAuthMaster::getAuthModel()::create($request->validated());
        $user->access_token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            "data" => $user,
        ], 201);
    }
}
