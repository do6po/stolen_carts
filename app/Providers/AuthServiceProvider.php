<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app['auth']->viaRequest(
            'api',
            function ($request) {
                if ($apiToken = $request->input('api_token')) {
                    return User::query()
                        ->where('api_token', $apiToken)
                        ->first();
                }

                return null;
            }
        );
    }
}
