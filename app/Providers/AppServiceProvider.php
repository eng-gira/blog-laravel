<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  Just a simple validation for illustration.
        Gate::define('admin', function (User $user) {
            return $user->username == 'Admin';
        });

        Blade::if('admin', function () {
            // if we have a user and if this use can('admin')
            return request()->user()?->can('admin');
        });
    }
}
