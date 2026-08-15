<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\PartnerAgreementController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressLogController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TroubleReportController;
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
    Route::resource('trouble-reports', TroubleReportController::class);

    Route::post('trouble-reports/{troubleReport}/advance-status', [TroubleReportController::class, 'advanceStatus'])
        ->name('trouble-reports.advance-status');
    Route::post('trouble-reports/{troubleReport}/updates', [TroubleReportController::class, 'addUpdate'])
        ->name('trouble-reports.add-update');

    Route::resource('partners', PartnerController::class);
    Route::resource('partner-agreements', PartnerAgreementController::class)->except(['index', 'show']);

    Route::resource('assets', AssetController::class);

    Route::resource('schedules', ScheduleController::class)->except(['show']);
    Route::post('schedules/{schedule}/mark-done', [ScheduleController::class, 'markDone'])
        ->name('schedules.mark-done');
});



require __DIR__ . '/auth.php';
