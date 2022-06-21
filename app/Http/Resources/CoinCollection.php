<?php

namespace App\Http\Resources;

use App\Models\Coin;
use Illuminate\Http\Resources\Json\JsonResource;

class CoinCollection extends JsonResource
{
    public $collect = Coin::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'created_at' => $this->created_at,
                'last_price' => new CoinPriceCollection($this->lastPrice),
                'historical_price' => new CoinPriceCollection($this->prices)
            ]
        ];
    }
}
