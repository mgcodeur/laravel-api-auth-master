<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth;

use Mgcodeur\LaravelApiAuthMaster\Facades\LaravelApiAuthMaster;
use Mgcodeur\LaravelApiAuthMaster\Http\Requests\Auth\AuthLoginRequest;

class AuthLoginController
{
    /**
     * @OA\Post(
     *  path="/api/auth/login",
     *  tags={"Auth"},
     *  summary="Login",
     *  description="Login the user",
     *
     *  @OA\RequestBody(
     *      required=true,
     *
     *      @OA\JsonContent(
     *
     *          @OA\Property(property="email", type="string", example="John@example.com", description="User's email"),
     *          @OA\Property(property="password", type="string", example="password", description="User's password"),
     *
     *      ),
     *  ),
     *
     * @OA\Response(
     *      response=200,
     *      description="User logged in successfully",
     *
     *      @OA\JsonContent(
     *
     *          @OA\Property(property="message", type="string", example="Login successful"),
     *      )
     *  ),
     * )
     */
    public function __invoke(AuthLoginRequest $request)
    {
        if (! auth()->attempt($request->validated())) {
            return response()->json([
                'message' => trans('mg-auth::auth.login.error.message'),
            ], 401);
        }

        $user = LaravelApiAuthMaster::getAuthModel()::where('email', $request->email)->first();

        return response()->json([
            'data' => [
                'access_token' => $user->createToken(config('api-auth-master.token.name'))->plainTextToken,
            ],
            'message' => trans('mg-auth::auth.login.success.message'),
        ]);
    }
}
