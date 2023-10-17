<?php
use \App\Http\Controllers\Frontend\LandingController;
use \App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\CartController;

Route::get('page/{slug}',[LandingController::class, 'page'])->name('page.index');
Route::get('/', [LandingController::class, 'index'])->name('/');
Route::get('blogs', [BlogController::class, 'index'])->name('blogs.list');
Route::get('blog/{slug}', [BlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('products/{category}', [ProductDetailController::class, 'getProductsByCategory'])->name('get.products-by-category');
Route::get('product/{slug}', [ProductDetailController::class, 'productDetail'])->name('product.productDetail');
Route::post('get-attribute-value', [ProductDetailController::class, 'getAttributeValue'])->name('product.getAttributeValue');
Route::post('get-product-group-value', [ProductDetailController::class, 'getProductGroupValue'])->name('product.getProductGroupValue');
Route::get('faqs', [LandingController::class, 'faq'])->name('faqs');
Route::get('packages', [LandingController::class, 'packages'])->name('packages');

Route::get('cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('checkout', [CartController::class, 'checkout'])->name('checkout.index');

Route::get('get-quote', [LandingController::class, 'getQuote'])->name('get-quote.index');
Route::post('get-quote/store', [LandingController::class, 'getQuoteStore'])->name('get-quote.store');

Route::get('contact-us', [LandingController::class, 'contactUs'])->name('contact-us.index');
Route::post('contact-us/store', [LandingController::class, 'contactUsStore'])->name('contact-us.store');
Route::get('thank-you/{id}', [CartController::class, 'thankYou'])->name('thank-you.index');
