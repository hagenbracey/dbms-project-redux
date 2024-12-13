<?php

use App\Http\Controllers\CallCenterController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\InquireOrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// customer service
Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service');
Route::post('/customer-service/search', [CustomerServiceController::class, 'search'])->name('customer-service.search');

// call center
Route::middleware(['auth'])->group(function () {
    Route::get('/call-center', [CallCenterController::class, 'index'])->name('call-center');
    Route::post('/call-center/order', [CallCenterController::class, 'storeOrder'])->name('call-center.store-order');
});

// shipments
Route::middleware(['auth'])->group(function () {
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments');
    Route::get('/shipments/search', [ShipmentController::class, 'search'])->name('shipments.search');
});

// orders
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [InquireOrdersController::class, 'index'])->name('orders');
    Route::get('/orders/search', [InquireOrdersController::class, 'search'])->name('orders.search');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
