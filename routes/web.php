<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\RedeemOptionController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\VoucherTemplateController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CUSTOMERS
    Route::resource('customers', CustomerController::class);

    // POINT
    Route::get('points/create', [PointController::class, 'create'])->name('points.create');
    Route::post('points', [PointController::class, 'store'])->name('points.store');

    // REEDEM
    Route::get('redeem/create', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('redeem', [RedeemController::class, 'store'])->name('redeem.store');

    // REEDEM OPTIONS
    Route::resource('redeem-options', RedeemOptionController::class);

    // HISTORY or REPORTS
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('history/export', [HistoryController::class, 'export'])->name('history.export');
});

require __DIR__ . '/auth.php';
