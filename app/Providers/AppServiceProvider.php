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
    Blade::if('manager', static function () {
      return (Auth::user() && Auth::user()->role == 1);
    });

    Blade::if('hrd', static function () {
      return (Auth::user() && Auth::user()->role == 2);
    });

    Blade::if('spv', static function () {
      return (Auth::user() && Auth::user()->role == 3);
    });

    Blade::if('admin', static function () {
      return (Auth::user() && Auth::user()->role == 4);
    });

    Blade::if('user', static function () {
      return (Auth::user() && Auth::user()->role == 5);
    });
  }
}
