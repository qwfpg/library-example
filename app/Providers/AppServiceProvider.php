<?php

namespace App\Providers;

use App\Services\EmployeeLoginLinkSender;
use App\Services\EmployeeLoginLinkSenderInterface;
use App\Services\ImageService;
use App\Services\ImageServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageServiceInterface::class, ImageService::class);
        $this->app->singleton(EmployeeLoginLinkSenderInterface::class, EmployeeLoginLinkSender::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
