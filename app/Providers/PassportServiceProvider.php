<?php

namespace App\Providers;

use App\SocialiteProviders\PassportProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;


class PassportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Socialite::extend('passport', function ($app) {
            $config = $app['config']['services.passport'];
            return new PassportProvider(
                $app['request'],
                $config['client_id'],
                $config['client_secret'],
                $config['redirect']
            );
        });
    }
}
