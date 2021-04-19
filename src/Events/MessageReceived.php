<?php

namespace Notf0und\BinanceWS\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;

class MessageReceived
{
    use Dispatchable, InteractsWithSockets;

    public string $payload;

    /**
     * Create a new event instance.
     *
     * @param string $payload
     *
     */
    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('binance-ws');
    }
}
