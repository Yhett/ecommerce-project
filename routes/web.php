<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| HOME PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $featuredProducts = Product::where('featured', true)->latest()->get();

    if ($featuredProducts->isEmpty()) {
        $featuredProducts = Product::latest()->take(4)->get();
    }

    return view('home', compact('featuredProducts'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| AUTH DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', function () {
    return redirect()->route('register');
})->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

/*
|--------------------------------------------------------------------------
| CART SYSTEM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add/{id}', [CartController::class, 'add']);
    Route::get('/cart/remove/{id}', [CartController::class, 'remove']);
});

/*
|--------------------------------------------------------------------------
| PAYMENT SYSTEM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success/{order}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
    Route::get('/payment/receipt/{order}', [PaymentController::class, 'receipt'])->name('payment.receipt');
});

/*
|--------------------------------------------------------------------------
| USER PRODUCT PAGES
|--------------------------------------------------------------------------
*/

Route::get('/products', [UserProductController::class, 'index']);
Route::get('/products/{id}', [UserProductController::class, 'show']);

/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/api/contact/{message}', [MessageController::class, 'show']);

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'store']);
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');
        Route::get('/', function () {
            $totalProducts = \App\Models\Product::count();
            $totalUsers = \App\Models\User::count();
            $totalCartItems = \App\Models\Cart::count();
            $featuredProducts = \App\Models\Product::where('featured', true)->count();
            $recentNotifications = \App\Models\StoreNotification::where('audience', 'admin')->latest()->take(5)->get();
            return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'totalCartItems', 'featuredProducts', 'recentNotifications'));
        })->name('admin.dashboard');
        Route::resource('products', AdminProductController::class);
        Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
        Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
        Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('admin.messages.reply');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');
    });
});

require __DIR__.'/auth.php';

