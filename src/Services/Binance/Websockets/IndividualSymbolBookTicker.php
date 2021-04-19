<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets;

class IndividualSymbolBookTicker extends Stream
{
    protected string $name;

    public function getName(): string
    {
        return $this->symbol . '@bookTicker';
    }
}
