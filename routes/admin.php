<?php
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\FeaturesController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PageController;

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

//  Country Routes
Route::controller(CountryController::class)->prefix('countries')->group(function () {
    Route::get('/', 'index')->name('backend.pages.country.index');
    Route::get('/create', 'create')->name('backend.pages.country.create');
    Route::post('/store', 'store')->name('backend.pages.country.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.country.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.country.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.country.destroy');
});

//  State Routes
Route::controller(StateController::class)->prefix('states')->group(function () {
    Route::get('/', 'index')->name('backend.pages.state.index');
    Route::get('/create', 'create')->name('backend.pages.state.create');
    Route::post('/store', 'store')->name('backend.pages.state.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.state.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.state.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.state.destroy');
});

//  City Routes
Route::controller(CityController::class)->prefix('cities')->group(function () {
    Route::get('/', 'index')->name('backend.pages.city.index');
    Route::get('/create', 'create')->name('backend.pages.city.create');
    Route::post('/store', 'store')->name('backend.pages.city.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.city.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.city.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.city.destroy');
});

//  Attribute Routes
Route::controller(AttributeController::class)->prefix('attributes')->group(function () {
    Route::get('/', 'index')->name('backend.pages.attribute.index');
    Route::get('/create', 'create')->name('backend.pages.attribute.create');
    Route::post('/store', 'store')->name('backend.pages.attribute.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.attribute.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.attribute.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.attribute.destroy');
});

//  Attribute Routes
Route::controller(AttributeController::class)->prefix('attributes')->group(function () {
    Route::get('/', 'index')->name('backend.pages.attribute.index');
    Route::get('/create', 'create')->name('backend.pages.attribute.create');
    Route::post('/store', 'store')->name('backend.pages.attribute.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.attribute.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.attribute.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.attribute.destroy');
});

//  Attribute Values Routes
Route::controller(AttributeValueController::class)->prefix('attribute-values')->group(function () {
    Route::get('/', 'index')->name('backend.pages.attribute-value.index');
    Route::get('/create', 'create')->name('backend.pages.attribute-value.create');
    Route::post('/store', 'store')->name('backend.pages.attribute-value.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.attribute-value.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.attribute-value.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.attribute-value.destroy');
});


//  Package Routes
Route::controller(PackageController::class)->prefix('packages')->group(function () {
    Route::get('/', 'index')->name('backend.pages.package.index');
    Route::get('/create', 'create')->name('backend.pages.package.create');
    Route::post('/store', 'store')->name('backend.pages.package.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.package.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.package.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.package.destroy');
});

//  page Routes
Route::controller(PageController::class)->prefix('pages')->group(function () {
    Route::get('/', 'index')->name('backend.pages.page.index');
    Route::get('/create', 'create')->name('backend.pages.page.create');
    Route::post('/store', 'store')->name('backend.pages.page.store');
    Route::get('/{id}/edit', 'edit')->name('backend.pages.page.edit');
    Route::post('/{id}/update', 'update')->name('backend.pages.page.update');
    Route::delete('/delete/{id}', 'destroy')->name('backend.pages.page.destroy');
});
