<?php

namespace App\Providers;

use App\Integrations\PlayerStatsInterface;
use App\Integrations\PremiereleagueClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        PlayerStatsInterface::class => PremiereleagueClient::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
