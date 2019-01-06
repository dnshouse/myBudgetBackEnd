<?php

namespace App\Firebase;

use Firebase\Auth\Token\Verifier;

class Guard
{
    protected $verifier;

    public function __construct(Verifier $verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * @param $request
     * @return User|void
     * @throws \Throwable
     */
    public function user($request)
    {
        $token = $request->bearerToken();
        try {
            $token = $this->verifier->verifyIdToken($token);
            return new User($token->getClaims());
        } catch (\Exception $e) {
            return;
        }
    }
}