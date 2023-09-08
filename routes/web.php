<?php

use \App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\FeaturesController;
use App\Http\Controllers\Backend\FAQController;
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


Route::get('/dashboard', function () {
    return view('backend.pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //  Brands Routes
    Route::controller(BrandController::class)->prefix('brands')->group(function () {
        Route::get('/', 'index')->name('backend.pages.brand.index');
        Route::get('/create', 'create')->name('backend.pages.brand.create');
        Route::post('/store', 'store')->name('backend.pages.brand.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.brand.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.brand.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.brand.destroy');
    });


    //  User Routes
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('backend.pages.users.index');
        Route::get('/create', 'create')->name('backend.pages.users.create');
        Route::post('/store', 'store')->name('backend.pages.users.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.users.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.users.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.users.destroy');
    });

    //  Category Routes
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'index')->name('backend.pages.categories.index');
        Route::get('/create', 'create')->name('backend.pages.categories.create');
        Route::post('/store', 'store')->name('backend.pages.categories.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.categories.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.categories.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.categories.destroy');
    });


    //  Features Routes
    Route::controller(FeaturesController::class)->prefix('features')->group(function () {
        Route::get('/', 'index')->name('backend.pages.features.index');
        Route::get('/create', 'create')->name('backend.pages.features.create');
        Route::post('/store', 'store')->name('backend.pages.features.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.features.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.features.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.features.destroy');
    });

    //  FAQ Routes
    Route::controller(FAQController::class)->prefix('faqs')->group(function () {
        Route::get('/', 'index')->name('backend.pages.faqs.index');
        Route::get('/create', 'create')->name('backend.pages.faqs.create');
        Route::post('/store', 'store')->name('backend.pages.faqs.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.faqs.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.faqs.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.faqs.destroy');
    });
});

require __DIR__.'/auth.php';
