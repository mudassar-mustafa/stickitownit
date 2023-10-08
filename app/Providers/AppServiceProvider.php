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
        $userId = Auth::check() == true ? Auth::user()->id : 0;
        view()->composer('*', function ($view) use($userId){
            $view->with([
                'categories' => Category::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'slug', 'image']),
                'pages' => Page::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'slug', 'name']),
                'cartCount' => Cart::where('user_id', $userId)->count(),
                'settings' => []
            ]);
        });
    }
}
