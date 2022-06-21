<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstimatedPriceRequest;
use App\Services\CoinService;
use App\Repository\CoinRepository;
use App\DTOs\CoinDto;
use App\Http\Resources\CoinCollection;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\EstimatedPriceResource;
use Exception;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class CoinController extends Controller
{
    protected $coinService;

    protected $coinRepository;

    protected $currency = [
        'usd',
        'eur',
        'brl'
    ];

    function __construct(CoinService $coinService, CoinRepository $coinRepository)
    {
        $this->coinService = $coinService;
        $this->coinRepository = $coinRepository;
    }

    function getCoinPrice(string $coin = 'bitcoin')
    {
        try {
            $findedCoin = $this->coinService->getLastCoinPrice($coin, $this->currency);
            if (count(reset($findedCoin)) === 0) {
                throw new NotFound('Coin not found');
            }
            return CoinCollection::make(
                $this->coinRepository->save(
                    COinDto::coinLastPriceDTO(
                        $findedCoin
                    ),
                    $this->coinRepository->find(
                        [
                            ['slug', '=', $coin]
                        ],
                        ['prices', 'lastPrice'],
                        true
                    )
                )
            );
        } catch (\Exception $e) {
            return ErrorResource::make(
                collect([
                    'error' => $e->getMessage()
                ])
            );
        }
    }

    function estimatedPrice(EstimatedPriceRequest $request, string $coin)
    {
        try {
            return EstimatedPriceResource::make(
                $this->coinRepository->getEstimatedPrice(
                    $coin,
                    CoinDto::estimatedPriceFilterDTO($request)
                )
            );
        } catch (\Exception $e) {
            return ErrorResource::make(
                collect([
                    'error' => $e->getMessage()
                ])
            );
        }
    }
}
