<?php
namespace Notf0und\BinanceWS\Services\Binance\Websockets\Client;

use Exception;
use Illuminate\Support\Facades\Log;
use Notf0und\BinanceWS\Events\MessageReceived;
use Ratchet\Client\Connector;
use React\EventLoop\Factory;
use React\Socket\Connector as SocketConnector;

class Ratchet
{
    public const PING = 0x09;
    public const PONG = 0x0A;

    protected $params;

    protected $connection;

    protected $loop;


    public function __construct($params)
    {
        $this->params = $params;
    }


    public function connect()
    {
        $loop = Factory::create();
        $this->loop = $loop;

        $socket = new SocketConnector($loop, ['timeout' => 30]);
        $connector = new Connector($loop, $socket);

        $connector($this->getHandshake())->then(
            [$this, 'connected'],
            [$this, 'error']
        );


        $loop->run();
    }

    public function error(Exception $exception)
    {
        Log::info($exception->getMessage());
        $this->close();
    }

    public function connected($connection)
    {
        $this->connection = $connection;
        $connection->on('message', [$this, 'message']);
    }

    public function message($payload)
    {
        if ($payload === self::PING && $this->connection) {
            $this->connection->send(self::PONG);
        }

        if ($payload === 'Goodbye!') {
            $this->close();
        }

        MessageReceived::dispatch($payload);
    }

    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }

        if ($this->loop) {
            $this->loop->stop();
        }
    }

    public function getBaseUrl()
    {
        return config('binance-ws.base_url');
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getQuery(): string
    {
        if (!is_string($this->params) && !is_array($this->params)) {
            return '';
        }

        if (is_string($this->params)) {
            return 'ws/' .  $this->params;
        }

        if (is_array($this->params) && $this->hasMultipleParameters()) {
            return'stream?streams=' . implode('/', $this->params);
        }

        return $this->params[0];
    }

    public function getRequest()
    {
    }

    public function getHandshake(): string
    {
        return implode('/', [
            $this->getBaseUrl() ,
            $this->getQuery()
        ]);
    }

    public function hasMultipleParameters(): bool
    {
        return is_array($this->params) && count($this->params) > 1;
    }
}
