<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $view->with([
                'categories' => Category::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'slug', 'image']),
                'settings' => []
            ]);
        });
    }
}
