<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EstimatedPriceRequest;
use App\Services\CoinService;
use App\Repository\CoinRepository;
use App\DTOs\CoinDto;
use App\Http\Resources\CoinCollection;
use App\Http\Resources\EstimatedPriceResource;

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
        return CoinCollection::make(
            $this->coinRepository->save(
                COinDto::coinLastPriceDTO(
                    $this->coinService->getLastCoinPrice($coin, $this->currency)
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
    }

    function estimatedPrice(EstimatedPriceRequest $request, string $coin)
    {
        return EstimatedPriceResource::make(
            $this->coinRepository->getEstimatedPrice(
                $coin,
                CoinDto::estimatedPriceFilterDTO($request)
            )
        );
    }
}
