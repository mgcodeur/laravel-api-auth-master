<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\AuthSocialite;

use Laravel\Socialite\Facades\Socialite;
use Mgcodeur\LaravelApiAuthMaster\Facades\LaravelApiAuthMaster;

class AuthSocialiteCallbackController
{
    public function __invoke($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $datas = $this->storeOrUpdateUser($user, $provider);

        return response()->json($datas, 200);
    }

    public function storeOrUpdateUser($providerUserInfos, $provider)
    {
        $user = LaravelApiAuthMaster::getAuthModel()::where('email', $providerUserInfos->email)->first();

        if (! $user) {
            $user = LaravelApiAuthMaster::getAuthModel()::create([
                'first_name' => $this->matchSocialFields($providerUserInfos, $provider)['first_name'],
                'last_name' => $this->matchSocialFields($providerUserInfos, $provider)['last_name'],
                'email' => $providerUserInfos->email,
                'password' => null,
                'email_verified_at' => now(),
                'password' => null,
            ]);

            $user->socialAccounts()->create([
                'provider_name' => $provider,
                'provider_id' => $providerUserInfos->id,
            ]);

            $user->access_token = $user->createToken('authToken')->plainTextToken;

            return [
                'user' => $user,
                'message' => 'User created',
            ];
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        $user->socialAccounts()->updateOrCreate(
            ['provider_id' => $providerUserInfos->id],
            ['provider_name' => $provider]
        );

        $user->access_token = $user->createToken('authToken')->plainTextToken;

        return [
            'user' => $user,
            'message' => 'User Logged In',
        ];
    }

    public function matchSocialFields($providerUserInfos, $provider)
    {
        return match ($provider) {
            'facebook' => [
                'first_name' => $providerUserInfos->user['first_name'],
                'last_name' => $providerUserInfos->user['last_name'],
            ],
            'google' => [
                'first_name' => $providerUserInfos->user['given_name'],
                'last_name' => $providerUserInfos->user['family_name'],
            ],
            'github' => [
                'first_name' => $providerUserInfos->user['name'],
                'last_name' => $providerUserInfos->user['name'],
            ],
            default => '',
        };
    }
}
