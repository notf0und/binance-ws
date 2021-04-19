<?php

namespace Notf0und\BinanceWS;

use Illuminate\Support\ServiceProvider;

class BinanceWSServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/binance-ws.php', 'binance-ws');
    }
}
