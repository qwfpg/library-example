<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\EmployeeLoginLinkSender;
use App\Services\EmployeeLoginLinkSenderInterface;
use App\Services\ImageService;
use App\Services\ImageServiceInterface;
use App\Services\NotificationService;
use App\Services\NotificationServiceInterface;
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
