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
use App\Http\Controllers\Backend\StickerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogTagController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\QuoteController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PackageSubscriptionController;
use App\Http\Controllers\ACL\RolesController;
use App\Http\Controllers\ACL\PermissionsController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ImageGenerationController;
use App\Http\Controllers\ProfileController;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'backend', 'middleware' => ['role:SuperAdmin|Admin|Seller|Customer']], function () {
    //  Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile',  'destroy')->name('profile.destroy');
        Route::post('/getStates', 'getStates')->name('backend.pages.profile.getStates');
        Route::post('/getCities', 'getCities')->name('backend.pages.profile.getCities');
    });
});

Route::group(['prefix' => 'backend', 'middleware' => ['role:SuperAdmin|Admin|Seller']], function () {

//  User Routes
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('backend.pages.users.index');
        Route::get('/create', 'create')->name('backend.pages.users.create');
        Route::post('/store', 'store')->name('backend.pages.users.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.users.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.users.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.users.destroy');
    });

//  Brands Routes
    Route::controller(BrandController::class)->prefix('brands')->group(function () {
        Route::get('/', 'index')->name('backend.pages.brand.index');
        Route::get('/create', 'create')->name('backend.pages.brand.create');
        Route::post('/store', 'store')->name('backend.pages.brand.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.brand.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.brand.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.brand.destroy');
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

//  Blogs Routes Start
    Route::controller(BlogController::class)->prefix('blogs')->group(function () {
        Route::get('/', 'index')->name('backend.pages.blogs.index');
        Route::get('/create', 'create')->name('backend.pages.blogs.create');
        Route::post('/store', 'store')->name('backend.pages.blogs.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.blogs.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.blogs.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.blogs.destroy');

        Route::post('/upload', 'upload')->name('backend.pages.blogs.media.upload');
        Route::get('/fetch/{id}', 'fetch')->name('backend.pages.blogs.media.fetch');
        Route::get('/media/delete', 'deleteMedia')->name('backend.pages.blogs.media.delete');


    });

//  Blogs Category Routes
    Route::controller(BlogCategoryController::class)->prefix('blogs/categories')->group(function () {
        Route::get('/', 'index')->name('backend.pages.blogs-categories.index');
        Route::get('/create', 'create')->name('backend.pages.blogs-categories.create');
        Route::post('/store', 'store')->name('backend.pages.blogs-categories.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.blogs-categories.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.blogs-categories.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.blogs-categories.destroy');
    });

//  Blogs Tags Routes
    Route::controller(BlogTagController::class)->prefix('blogs/tags')->group(function () {
        Route::get('/', 'index')->name('backend.pages.blogs-tags.index');
        Route::get('/create', 'create')->name('backend.pages.blogs-tags.create');
        Route::post('/store', 'store')->name('backend.pages.blogs-tags.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.blogs-tags.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.blogs-tags.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.blogs-tags.destroy');
    });

//  Products Routes
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('/', 'index')->name('backend.pages.product.index');
        Route::get('/create', 'create')->name('backend.pages.product.create');
        Route::post('/store', 'store')->name('backend.pages.product.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.product.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.product.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.product.destroy');
        Route::post('/get/attribute-values', 'getAttributeValues')->name('backend.pages.product.getAttributeValues');
        Route::post('/get/combination', 'getCombination')->name('backend.pages.product.getCombination');
        Route::get('/import-data', 'import_data')->name('backend.pages.product.import_data');
        Route::get('/{id}/variation/edit', 'variationEdit')->name('backend.pages.product.variationEdit');
        Route::post('/update/variation', 'updateVariation')->name('backend.pages.product.updateVariation');
        Route::delete('/delete/variation/{id}', 'destroyVariation')->name('backend.pages.product.destroyVariation');

        Route::post('/upload', 'upload')->name('backend.pages.product.media.upload');
        Route::get('/fetch/{id}', 'fetch')->name('backend.pages.product.media.fetch');
        Route::get('/media/delete', 'deleteMedia')->name('backend.pages.product.media.delete');
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

//  Pages Routes
    Route::controller(PageController::class)->prefix('pages')->group(function () {
        Route::get('/', 'index')->name('backend.pages.page.index');
        Route::get('/create', 'create')->name('backend.pages.page.create');
        Route::post('/store', 'store')->name('backend.pages.page.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.page.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.page.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.page.destroy');
    });

//  Stickers Routes
    Route::controller(StickerController::class)->prefix('stickers')->group(function () {
        Route::get('/', 'index')->name('backend.pages.sticker.index');
        Route::get('/create', 'create')->name('backend.pages.sticker.create');
        Route::post('/store', 'store')->name('backend.pages.sticker.store');
        Route::get('/{id}/edit', 'edit')->name('backend.pages.sticker.edit');
        Route::post('/{id}/update', 'update')->name('backend.pages.sticker.update');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.sticker.destroy');
    });

//  Contact Us Routes
    Route::controller(ContactUsController::class)->prefix('contact-us')->group(function () {
        Route::get('/', 'index')->name('backend.pages.contact-us.index');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.contact-us.destroy');
    });

//  Quote Us Routes
    Route::controller(QuoteController::class)->prefix('quote')->group(function () {
        Route::get('/', 'index')->name('backend.pages.quote.index');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.quote.destroy');
    });

// Permissions
    Route::controller(PermissionsController::class)->prefix('permissions')->group(static function () {

        Route::GET('/', 'index')->name('backend.permissions.index');
        Route::GET('create', 'create')->name('backend.permissions.create');
        Route::POST('store', 'store')->name('backend.permissions.store');
        Route::GET('{id}/edit', 'edit')->name('backend.permissions.edit');
        Route::POST('{id}/update', 'update')->name('backend.permissions.update');
        Route::DELETE('destroy/{id?}', 'destroy')->name('backend.permissions.destroy');

    });

// Roles
    Route::controller(RolesController::class)->prefix('roles')->group(static function () {

        Route::GET('/', 'index')->name('backend.roles.index');
        Route::GET('create', 'create')->name('backend.roles.create');
        Route::POST('store', 'store')->name('backend.roles.store');
        Route::GET('{id}/edit', 'edit')->name('backend.roles.edit');
        Route::POST('{id}/update', 'update')->name('backend.roles.update');
        Route::DELETE('destroy/{id?}', 'destroy')->name('backend.roles.destroy');

    });
// Settings
    Route::controller(SettingController::class)->prefix('settings')->group(static function () {
        Route::GET('/', 'edit')->name('backend.settings.index');
        Route::POST('update', 'update')->name('backend.settings.update');
    });
});


Route::group(['prefix' => 'backend', 'middleware' => ['role:Customer']], function () {
// Package Subscription  Routes
    Route::controller(PackageSubscriptionController::class)->prefix('package-subscription')->group(function () {
        Route::get('/', 'index')->name('backend.pages.package-subscription.index');
    });
});

Route::group(['prefix' => 'backend'], function () {
//  Order Routes
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('/sales/list/{buyerIds?}/{sellerIds?}/{categoryIds?}/{orderDate?}/{shipDate?}', 'saleOrder')->name('backend.pages.order.sale_order')->middleware('role:SuperAdmin|Admin|Customer|Seller');
        Route::get('/packages/list/{buyerIds?}/{orderDate?}', 'packageOrder')->name('backend.pages.order.package_order')->middleware('role:SuperAdmin|Admin|Customer');
        Route::post('/update-order-status', 'updateOrderStatus')->name('backend.pages.order.updateOrderStatus')->middleware('role:SuperAdmin|Admin|Seller');
        Route::delete('/delete/{id}', 'destroy')->name('backend.pages.order.destroy')->middleware('role:SuperAdmin|Admin|Customer|Seller');
        Route::post('/getOrderDetail', 'getOrderDetail')->name('backend.pages.order.getOrderDetail')->middleware('role:SuperAdmin|Admin|Seller|Customer');
        Route::post('/storeFeedback', 'storeFeedback')->name('backend.pages.order.storeFeedback')->middleware('role:Customer');
    });

    //  Stickers Routes
    Route::controller(ImageGenerationController::class)->prefix('generations')->group(function () {
        Route::get('/', 'index')->name('backend.pages.generations.index')->middleware('role:SuperAdmin|Admin|Customer|Seller');
        Route::get('/download/{id}', 'download')->name('backend.pages.generations.download')->middleware('role:SuperAdmin|Admin|Customer|Seller');
    });
});
