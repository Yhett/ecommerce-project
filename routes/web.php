<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\UserController;

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
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
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
    });
});

require __DIR__.'/auth.php';
