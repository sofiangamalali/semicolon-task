<?php

namespace App\Providers;

use App\Interfaces\AuthRepoInterface;
use App\Interfaces\GroupRepoInterface;
use App\Interfaces\PermissionRepoInterface;
use App\Interfaces\UserRepoInterface;
use App\Repositories\AuthRepo;
use App\Repositories\GroupRepo;
use App\Repositories\PermissionRepo;
use App\Repositories\UserRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepoInterface::class, AuthRepo::class);
        $this->app->bind(UserRepoInterface::class, UserRepo::class);
        $this->app->bind(GroupRepoInterface::class, GroupRepo::class);
        $this->app->bind(PermissionRepoInterface::class, PermissionRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
