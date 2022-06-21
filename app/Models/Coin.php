<?php

namespace App\Models;

use App\Enums\TrueOrFalse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $table = 'coin';

    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function prices()
    {
        return $this->hasMany(CoinPrice::class, 'coin_id');
    }

    public function lastPrice()
    {
        return $this->hasMany(CoinPrice::class, 'coin_id')->where('last_price', '=', TrueOrFalse::TRUE);
    }
}
