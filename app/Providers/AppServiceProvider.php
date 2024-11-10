<?php

namespace App\Providers;

use App\Services\CastMemberService;
use App\Services\MovieService;
use App\Services\ScreenshotService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MovieService::class, function ($app) {
            return new MovieService();
        });
        $this->app->singleton(CastMemberService::class, function ($app) {
            return new CastMemberService();
        });


        $this->app->singleton(ScreenshotService::class, function ($app) {
            return new ScreenshotService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        App::setLocale(Session::get('locale', config('app.locale')));
    }
}
