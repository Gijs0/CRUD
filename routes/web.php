<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\CartController;

// Welcome page
Route::get('/', [FestivalController::class, 'welcome'])->name('welcome');

// Product routes
Route::resource('products', ProductController::class);

// Order routes
Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

// Festival routes
Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('/festivals/{festival}', [FestivalController::class, 'show'])->name('festivals.show');
Route::post('/festivals/{festival}/tickets', [TicketController::class, 'store'])
     ->name('festivals.tickets.store');

// Authentication routes
Auth::routes();

// Admin routes
Route::middleware(['auth', 'can:admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         // Categories
         Route::resource('categories', CategoryController::class);
         
         // Festivals
         Route::resource('festivals', FestivalController::class);
         
         // Orders
         Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
         Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
         Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
     });

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Festival routes
    Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
    Route::get('/festivals/{festival}', [FestivalController::class, 'show'])->name('festivals.show');
    Route::middleware('can:manage-festivals')->group(function () {
        Route::get('/festivals/create', [FestivalController::class, 'create'])->name('festivals.create');
        Route::post('/festivals', [FestivalController::class, 'store'])->name('festivals.store');
        Route::get('/festivals/{festival}/edit', [FestivalController::class, 'edit'])->name('festivals.edit');
        Route::put('/festivals/{festival}', [FestivalController::class, 'update'])->name('festivals.update');
        Route::delete('/festivals/{festival}', [FestivalController::class, 'destroy'])->name('festivals.destroy');
    });

    // Ticket routes
    Route::get('/festivals/{festival}/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::middleware('can:manage-tickets')->group(function () {
        Route::get('/festivals/{festival}/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/festivals/{festival}/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/festivals/{festival}/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/festivals/{festival}/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
        Route::delete('/festivals/{festival}/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    });

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::middleware('can:manage-orders')->group(function () {
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });
});

require __DIR__.'/auth.php';