<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinPrice extends Model
{
    use HasFactory;

    const LAST_PRICE = 1;

    protected $table = 'coin_price';

    protected $fillable = [
        'id',
        'coin_id',
        'currency',
        'price',
        'last_price'
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
