<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;


Route::get('create-token', function (Request $request) {
    $token = $request->user()->createToken('rafael');
    return ['token' => $token->plainTextToken];
});

Route::get('coins', [CoinController::class, 'index'])->name('coins.list');
Route::get('price/{coin}', [CoinController::class, 'getCoinPrice'])->name('coin.price');
Route::get('estimated-price/{coin}', [CoinController::class, 'estimatedPrice'])->name('estimated.price');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
