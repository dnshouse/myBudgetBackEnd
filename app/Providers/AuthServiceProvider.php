<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Firebase\Auth\Token\Verifier;
use Illuminate\Http\Request;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('firebase', function (Request $request) {
            $token = app(Verifier::class)->verifyIdToken($request->bearerToken());
            return User::firstOrCreate([
                'fire_base_user_id' => $token->getClaim('user_id'),
                'email' => $token->getClaim('email')
            ]);
        });
    }
}
