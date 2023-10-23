<?php

use \App\Http\Controllers\Frontend\LandingController;
use \App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\SocialController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('auth/google', [SocialController::class, 'signInwithGoogle']);
Route::get('callback/google', [SocialController::class, 'callbackToGoogle']);

require __DIR__ . '/frontend.php';


Route::middleware('auth')->group(function () {
    Route::post('add-to-cart', [ProductDetailController::class, 'addToCart'])->name('product.addToCart');
    Route::post('remove-to-cart', [CartController::class, 'removeToCart'])->name('product.removeToCart');
    Route::post('place-order', [CartController::class, 'placeOrder'])->name('placeOrder');
    Route::post('get-states', [CartController::class, 'getStates'])->name('getStates');
    Route::post('get-cities', [CartController::class, 'getCities'])->name('getCities');
    Route::post('add-to-cart-packages', [CartController::class, 'addToCartPackage'])->name('addToCartPackage');

    require __DIR__ . '/admin.php';


});

require __DIR__ . '/auth.php';
