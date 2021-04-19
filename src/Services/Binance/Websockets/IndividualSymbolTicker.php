<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets;

class IndividualSymbolTicker extends Stream
{
    protected string $name;

    public function getName(): string
    {
        return $this->symbol . '@ticker';
    }
}
