<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('email_domain', function($attribute, $value, $parameters, $validator) {
            $allowedEmailDomains = ['petsafe.net'];
            return in_array( explode('@', $parameters[0])[1] , $allowedEmailDomains);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
