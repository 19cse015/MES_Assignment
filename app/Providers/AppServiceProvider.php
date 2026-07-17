<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
