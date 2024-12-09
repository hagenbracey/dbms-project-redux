<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\CallCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service');
Route::post('/customer-service/search', [CustomerServiceController::class, 'search'])->name('customer-service.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/call-center', [CallCenterController::class, 'index'])->name('call-center');
    Route::post('/call-center/order', [CallCenterController::class, 'storeOrder'])->name('call-center.store-order');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
