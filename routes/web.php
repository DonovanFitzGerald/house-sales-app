<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HouseController;
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

Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');
Route::get('/houses/{house}', [HouseController::class, 'show'])->name('houses.show');
Route::get('/houses/create', [HouseController::class, 'create'])->name('houses.create');
Route::post('/houses', [HouseController::class, 'store'])->name('houses.store');

require __DIR__.'/auth.php';