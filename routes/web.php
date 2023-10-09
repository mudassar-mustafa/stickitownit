<?php

use \App\Http\Controllers\Frontend\LandingController;
use \App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\CartController;

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

Route::get('page/{slug}',[LandingController::class, 'page'])->name('page.index');
Route::get('/', [LandingController::class, 'index'])->name('/');
Route::get('blogs', [BlogController::class, 'index'])->name('blogs.list');
Route::get('blog/{slug}', [BlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('product/{slug}', [ProductDetailController::class, 'productDetail'])->name('product.productDetail');
Route::post('getAttributeValue', [ProductDetailController::class, 'getAttributeValue'])->name('product.getAttributeValue');
Route::post('getProductGroupValue', [ProductDetailController::class, 'getProductGroupValue'])->name('product.getProductGroupValue');
Route::get('faqs', [LandingController::class, 'faq'])->name('faqs');

Route::get('cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('checkout', [CartController::class, 'checkout'])->name('checkout.index');

Route::get('/dashboard', function () {
    return view('backend.pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('addToCart', [ProductDetailController::class, 'addToCart'])->name('product.addToCart');
    Route::post('removeToCart', [CartController::class, 'removeToCart'])->name('product.removeToCart');

    require __DIR__ . '/admin.php';


});

require __DIR__ . '/auth.php';
