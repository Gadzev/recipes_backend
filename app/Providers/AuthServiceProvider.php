<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
       $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
       
        Passport::tokensExpireIn(Carbon::now()->addMinutes(env('TOKEN_EXPIRY')));
        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(env('REFRESH_TOKEN_EXPIRY')));
    }
}
