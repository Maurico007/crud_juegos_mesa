<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\FabricanteController;

Route::get('/', function () {
    return redirect()->route('juegos.index');
});

Route::resource('juegos', JuegoController::class);
Route::resource('fabricantes', FabricanteController::class);

