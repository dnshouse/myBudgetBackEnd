<?php

namespace App\Firebase;

use Firebase\Auth\Token\Verifier;
use Illuminate\Http\Request;

class Guard
{
    protected $verifier;

    /**
     * @param Verifier $verifier
     */
    public function __construct(Verifier $verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * @param Request $request
     * @return User
     * @throws \Throwable
     */
    public function user(Request $request)
    {
        $token = $request->bearerToken();
        $token = $this->verifier->verifyIdToken($token);

        return new User($token->getClaims());
    }
}