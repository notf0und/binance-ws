<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets;

use Notf0und\BinanceWS\Jobs\BinanceListenerJob;
use Notf0und\BinanceWS\Jobs\WebsocketsSubscribeJob;

abstract class Stream
{
    abstract public function getName();

    protected string $symbol = 'btcusdt';

    public function setSymbol(string $symbol)
    {
        $this->symbol = strtolower($symbol);
    }

    public function __toString() : string
    {
        return $this->getName();
    }

    public function toString() : string
    {
        return $this->__toString();
    }

    public function getCacheKey(): string
    {
        return implode('.', [get_called_class(), $this->id]);
    }
}
