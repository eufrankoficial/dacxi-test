<?php

namespace App\Repository;

use App\Enums\TrueOrFalse;
use App\Models\Coin;
use Illuminate\Database\Eloquent\Builder;

class CoinRepository implements RepositoryInterface
{
    protected $model;

    function __construct(Coin $model)
    {
        $this->model = $model;
    }

    function save(array $data = [], $model = null): Coin
    {
        if ($model != null) {
            $coin = $model->update($data['coin']);

            $this->updateLastPrice(
                $model,
                [
                    ['last_price', '=', TrueOrFalse::TRUE]
                ],
                ['last_price' => TrueOrFalse::FALSE]
            );
        } else {
            $coin = $this->model->create($data['coin']);
        }

        $givenParam = $coin instanceof Coin ? $coin : $model;
        $this->createPrice(
            $givenParam,
            $data['prices']
        );

        return $givenParam;
    }

    function find(array $conditions = [], array $with = [], $withLastPrice = false): ?Coin
    {
        $coinModel = $this->model;
        if (count($with) > 0) {
            $coinModel->with($with);
        }

        return $coinModel->where($conditions)->first();
    }

    function updateLastPrice(Coin $model, array $conditions = [], array $data = [])
    {
        return $model->prices()
            ->where($conditions)
            ->update($data);
    }

    function createPrice(Coin $coin, array $prices = []): Coin
    {
        $coin->prices()->createMany($prices);

        return $coin;
    }

    function getEstimatedPrice(string $coin, array $conditions = []): ?Coin
    {
        return $this->model
            ->with(
                [
                    'prices' => function ($query) use ($conditions) {
                        $query->whereRaw('date(coin_price.created_at) = "' . $conditions['date'] . '" AND time(coin_price.created_at) LIKE "' . $conditions['time'] . '%"');
                    }
                ],

            )
            ->where('slug', $coin)
            ->whereHas('prices', function (Builder $query) use ($conditions) {
                $query->whereRaw('date(coin_price.created_at) = "' . $conditions['date'] . '" AND time(coin_price.created_at) LIKE "' . $conditions['time'] . '%"');
            })->first();
    }
}
