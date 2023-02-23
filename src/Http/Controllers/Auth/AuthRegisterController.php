<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth;

use Mgcodeur\LaravelApiAuthMaster\Http\Requests\Auth\AuthRegisterRequest;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster;

class AuthRegisterController
{
    public function __invoke(AuthRegisterRequest $request)
    {
        $user = LaravelApiAuthMaster::getAuthModel()::create($request->validated());
        $user->access_token = $user->createToken(config('api-auth-master.token.name'))->plainTextToken;
        //TODO: send email to user with link or code to verify email
        return response()->json([
            'data' => $user,
            'message' => trans('mg-auth::auth.register.success.message'),
        ], 201);
    }
}
