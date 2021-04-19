<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets;


class KlineCandlestick extends Stream
{
    protected string $name;

    public string $interval = '1m';

    public function getName(): string
    {
        return $this->symbol . '@kline_' . $this->interval;
    }

    public function setInterval(string $interval)
    {
        $this->interval = $interval;
    }
}