<?php

namespace Notf0und\BinanceWS\Facades;

use Illuminate\Support\Facades\Facade;

class BinanceWS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'binance-ws';
    }
}
