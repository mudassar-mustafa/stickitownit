<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BrandController;
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

Route::get('/', function () {
    return view('frontend.pages.index');
});

Route::get('/dashboard', function () {
    return view('backend.pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(BrandController::class)->prefix('brand')->group(function () {
        Route::get('/', 'index')->name('backend.pages.brand.index');
        Route::get('/create', 'create')->name('backend.pages.brand.create');
        Route::post('/store', 'store')->name('backend.pages.brand.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.brand.edit');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.brand.destroy');
    });
    
});

require __DIR__.'/auth.php';
