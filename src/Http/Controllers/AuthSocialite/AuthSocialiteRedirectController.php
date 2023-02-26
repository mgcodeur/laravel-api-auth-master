<?php

namespace Mgcodeur\LaravelApiAuthMaster\Http\Controllers\AuthSocialite;

use Laravel\Socialite\Facades\Socialite;

class AuthSocialiteRedirectController
{
    /**
     * @OA\Get(
     *  path="/api/auth/{provider}",
     *  tags={"Social authentication"},
     *  summary="redirect to social provider (provider ex: google, facebook, github, ...)",
     *  description="get redirect url for social login",
     *
     *  @OA\Parameter(
     *      name="provider",
     *      description="provider name",
     *      required=true,
     *      in="path",
     *  ),
     *
     * @OA\Response(
     *      response=200,
     *      description="redirect url",
     *
     *      @OA\JsonContent(
     *
     *          @OA\Property(property="message", type="string"),
     *      )
     *  ),
     * )
     */
    public function __invoke($provider)
    {
        $redirectUrl = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response()->json(['redirect_url' => $redirectUrl]);
    }
}
