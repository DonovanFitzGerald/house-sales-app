<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/houses', [HouseController::class, 'index'] );