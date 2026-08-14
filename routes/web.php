<?php

use App\Http\Controllers\LahanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressLogController;
use App\Http\Controllers\TransactionController;
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
    Route::resource('lahans', LahanController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('progress-logs', ProgressLogController::class);
});



require __DIR__ . '/auth.php';
