<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstimatedPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (!isset($this->name)) {
            return [];
        }

        return [
            'data' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'created_at' => $this->created_at,
                'prices' => new CoinPriceCollection($this->prices),
            ]
        ];
    }
}
