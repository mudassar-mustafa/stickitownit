<?php

use \App\Http\Controllers\Frontend\LandingController;
use \App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ProductDetailController;

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

Route::get('/', [LandingController::class, 'index'])->name('/');
Route::get('blogs', [BlogController::class, 'index'])->name('blogs.list');
Route::get('blog/{slug}', [BlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('product_detail/{slug}', [ProductDetailController::class, 'productDetail'])->name('product.productDetail');


Route::get('/dashboard', function () {
    return view('backend.pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    require __DIR__ . '/admin.php';


});

require __DIR__ . '/auth.php';
