<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;

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
        view()->composer('*', function ($view){
            $view->with([
                'categories' => Category::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'slug', 'image']),
                'pages' => Page::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'slug', 'name']),
                'settings' => []
            ]);
        });
    }
}
