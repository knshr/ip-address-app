<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(\App\Repositories\Contracts\AuditLogRepository::class, \App\Repositories\Eloquent\AuditLogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\IPAddressRepository::class, \App\Repositories\Eloquent\IPAddressRepositoryEloquent::class);
    }
}