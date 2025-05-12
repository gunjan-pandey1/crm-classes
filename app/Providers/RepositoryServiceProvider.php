<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\ModelAccessRepository;
use App\Repository\DBV1\ModelAccessRepositoryImpl;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ModelAccessRepository::class, ModelAccessRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
