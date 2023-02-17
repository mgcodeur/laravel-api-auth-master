<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthRegisterController
{
    public function __invoke(Request $request) {
        $validator = Validator::make($request->all(), [
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8|confirmed",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }
    }
}
