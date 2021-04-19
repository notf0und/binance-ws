<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets;

class AllBookTickers extends Stream
{
    protected string $name;

    public function getName(): string
    {
        return '!bookTicker';
    }
}
