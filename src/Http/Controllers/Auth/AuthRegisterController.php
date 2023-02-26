<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth;

use Mgcodeur\LaravelApiAuthMaster\Http\Requests\Auth\AuthRegisterRequest;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster;

class AuthRegisterController
{
    /**
     * @OA\Post(
     *  path="/api/auth/register",
     *  tags={"Form authentication"},
     *  summary="Register",
     *  description="Register a new user",
     *
     *  @OA\RequestBody(
     *      required=true,
     *
     *      @OA\JsonContent(
     *
     *          @OA\Property(property="first_name", type="string", example="John", description="User's first name"),
     *          @OA\Property(property="last_name", type="string", example="Doe", description="User's last name"),
     *          @OA\Property(property="email", type="string", example="johndoe@example.com", description="User's email address"),
     *          @OA\Property(property="password", type="string", example="password123", description="User's password"),
     *          @OA\Property(property="password_confirmation", type="string", example="password123", description="Password confirmation must be the same as password"),
     *      ),
     *  ),
     *
     *  @OA\Response(
     *      response=201,
     *      description="User created successfully",
     *
     *      @OA\JsonContent(
     *
     *          @OA\Property(property="message", type="string", example="User created successfully")
     *      )
     *  ),
     * ),
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
