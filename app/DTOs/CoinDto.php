<?php

namespace App\DTOs;

use Carbon\Carbon;
use Illuminate\Http\Request;

class COinDto
{
    public static function coinLastPriceDTO(array $data = [])
    {
        $coinsToSave = [];
        foreach (reset($data) as $coin => $price) {
            $coinPrice = [];

            foreach ($price as $key => $p) {
                $coinPrice[] = [
                    'currency' => $key,
                    'price' => $p,
                    'last_price' => 1
                ];
            }

            $coinsToSave[] = [
                'coin' => [
                    'name' => $coin,
                    'slug' => $coin
                ],
                'prices' => $coinPrice
            ];
        }

        return reset($coinsToSave);
    }


    public static function estimatedPriceFilterDTO(Request $request)
    {
        return [
            'date' => Carbon::createFromFormat('d-m-Y', $request->get('date'))->format('Y-m-d'),
            'time' => Carbon::createFromFormat('H:i', $request->get('time'))->format('H:i')
        ];
    }
}
