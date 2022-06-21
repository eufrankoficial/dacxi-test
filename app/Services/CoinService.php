<?php

namespace App\Services;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinService
{
    protected $coinGeckoClient;

    function __construct(CoinGeckoClient $coinGeckoClient)
    {
        $this->coinGeckoClient = new $coinGeckoClient();
    }

    public function testEndPoint()
    {
        return $this->coinGeckoClient->ping();
    }

    public function getCoinList()
    {
        return $this->coinGeckoClient->coins()->getList();
    }

    public function getHistory($coin, $date)
    {
        return $this->coinGeckoClient->coins()->getHistory($coin, $date);
    }

    public function getLastCoinPrice(string $coin, array $currency = [])
    {
        return [
            $this->coinGeckoClient->simple()->getPrice($coin, arrayToSeparatedComma($currency))
        ];
    }
}
