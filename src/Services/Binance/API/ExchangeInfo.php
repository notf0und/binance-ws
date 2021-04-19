<?php
namespace Notf0und\BinanceWS\Services\Binance\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class ExchangeInfo
{
    public string $timezone;

    public int $serverTime;

    public array $rateLimits;

    public array $exchangeFilters;

    public Collection $symbols;

    public function __construct()
    {
        $response = Http::get('https://api.binance.com/api/v3/exchangeInfo');
        $json = $response->json();
        $this->timezone = $json['timezone'];
        $this->serverTime = $json['serverTime'];
        $this->rateLimits = $json['rateLimits'];
        $this->exchangeFilters = $json['exchangeFilters'];
        $this->symbols = collect($json['symbols']);
        return $this;
    }

    public function getSymbolsList()
    {
        return array_map(
            'strtolower',
            $this->symbols->pluck('symbol')
                ->sort()
                ->values()
                ->all()
        );
    }
}
