<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets;

class IndividualSymbolMiniTicker extends Stream
{
    protected string $name;

    public function getName(): string
    {
        return $this->symbol . '@miniTicker';
    }
}
