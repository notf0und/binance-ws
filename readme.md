# Binance-WS for Laravel
A websockets client to get data from crypto exchange Binance.

## Installation
``` bash
composer require notf0und/laravel-ws-binance
```


## Available streams:
* ####AggregateTrade
* ####AllBookTickers
* ####IndividualSymbolBookTicker
* ####IndividualSymbolMiniTicker
* ####IndividualSymbolTicker
* ####KlineCandlestick
* ####Trade

## Usage example
``` php
use Notf0und\BinanceWS\Services\Binance\Websockets\AggregateTrade;
use Notf0und\BinanceWS\Services\Binance\Websockets\AllBookTickers;
use Notf0und\BinanceWS\Services\Binance\Websockets\KlineCandlestick;
use Notf0und\BinanceWS\Services\Binance\Websockets\Client\Ratchet as Client;

// Default config (btcusdt symbol)
$allBookTickers = new AllBookTickers();

// Change symbol
$aggregateTrade = new AggregateTrade();
$aggregateTrade->setSymbol('ethbtc');

// Change symbol and interval (just KlineCandlestick class allow to set interval)
$kline = new KlineCandlestick();
$kline->setSymbol('ethusdt');
$kline->setInterval('15m');

// Create the client with the previously created streams
$client = new Client([
    (string) $allBookTickers,
    $aggregateTrade->toString(),
    $kline->toString()
]);

//Connect
$client->connect()
```

If everything goes well, each message received would be firing the event \Notf0und\BinanceWS\Events\MessageReceived containing the payload attribute.

So now we can attach to it some event listener/s, like the following.

``` php
// App\Providers\EventServiceProvider.php

use Notf0und\BinanceWS\Events\MessageReceived;
use App\Listeners\MyCustomEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageReceived::class => [
            MyCustomEventListener::class
        ]
    ];
```

On the event listener we can, for example, write the content received to the log:

```php
namespace App\Listeners;

class MyCustomEventListener
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Log::info($event->payload);
    }
}


```
By default this package add a listener to the WebsocketsUpdate Event that writes the payload received to the cache, that can be accessed as following:
``` php
while(true) {
    echo Cache::get($stream->getCacheKey());
    sleep(1);
}
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email gonzartur@gmail.com instead of using the issue tracker.

## Credits

- [Fabián Gonzalo Artur de la Villarmois][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/notf0und/laravel-ws-binance.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/notf0und/laravel-ws-binance.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/notf0und/laravel-ws-binance/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/notf0und/laravel-ws-binance
[link-downloads]: https://packagist.org/packages/notf0und/laravel-ws-binance
[link-travis]: https://travis-ci.org/notf0und/laravel-ws-binance
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/notf0und
[link-contributors]: ../../contributors
