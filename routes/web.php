<?php

use App\Http\Controllers\BidController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealtorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('houses', HouseController::class);
Route::resource('houses.bids', BidController::class);
Route::resource('realtors', RealtorController::class);

// Realtor assignment routes
Route::get('/houses/{house}/select-realtor', [HouseController::class, 'selectRealtor'])->name('houses.select-realtor');
Route::post('/houses/{house}/assign-realtor', [HouseController::class, 'assignRealtor'])->name('houses.assign-realtor');
Route::post('/houses/{house}/remove-realtor', [HouseController::class, 'removeRealtor'])->name('houses.remove-realtor');

require __DIR__.'/auth.php';