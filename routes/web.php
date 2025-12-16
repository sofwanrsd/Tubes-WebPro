<?php

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publisher\PublisherBookController;
use App\Http\Controllers\Publisher\PublisherDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{bookId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{bookId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardRedirectController::class, 'index'])->name('dashboard');

    // checkout & payment
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');

    Route::get('/payment/{orderId}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{orderId}/check', [PaymentController::class, 'check'])->name('payment.check');

    // user orders
    Route::get('/my/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/my/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/my/orders/{orderId}/download/{bookId}', [DownloadController::class, 'download'])->name('orders.download');

    // USER dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('role:user|publisher|admin')
        ->name('user.dashboard');

    // PUBLISHER
    Route::prefix('publisher')->name('publisher.')->middleware('role:publisher|admin')->group(function () {
        Route::get('/dashboard', [PublisherDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/books', PublisherBookController::class)->names('books');
    });

    // ADMIN
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users/{userId}/role', [AdminUserController::class, 'updateRole'])->name('users.role');

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{orderId}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{orderId}/manual-confirm', [AdminOrderController::class, 'manualConfirm'])->name('orders.manual_confirm');

        Route::get('/books', [AdminBookController::class, 'index'])->name('books.index');
        Route::post('/books/{bookId}/status', [AdminBookController::class, 'setStatus'])->name('books.status');
    });
});

require __DIR__.'/auth.php';
