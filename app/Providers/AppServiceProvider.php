<?php

namespace App\Providers;

use Stancl\JobPipeline\JobPipeline;
use Illuminate\Support\Facades\Event;
use Stancl\Tenancy\Jobs\SeedDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Jobs\CreateDatabase;
use Stancl\Tenancy\Events\DomainCreated;
use Stancl\Tenancy\Events\TenantCreated;
use Stancl\Tenancy\Jobs\MigrateDatabase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(TenantCreated::class, JobPipeline::make([
            CreateDatabase::class,
            MigrateDatabase::class,
            SeedDatabase::class,
        ])->send(function (TenantCreated $event) {
            return $event->tenant;
        })->shouldBeQueued(true)->toListener());

        Event::listen(DomainCreated::class, function () {
            Artisan::call('queue:work --once');
        });
    }
}
