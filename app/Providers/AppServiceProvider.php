<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }


    public function boot(): void
    {
        Blade::if('admin', static function () {
            return (Auth::user() && Auth::user()->role == 0);
        });

        Blade::if('member', static function () {
            return (Auth::user() && Auth::user()->role == 1);
        });
    }
}
