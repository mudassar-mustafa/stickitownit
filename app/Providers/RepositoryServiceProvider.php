<?php

namespace App\Providers;

use App\Contracts\Backend\BrandContract;
use App\Contracts\Backend\CategoryContract;
use App\Contracts\Backend\FaqContract;
use App\Contracts\Backend\FeatureContract;
use App\Contracts\Backend\UserContract;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\FaqRepository;
use App\Repositories\Backend\FeatureRepository;
use App\Repositories\Backend\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Backend\BrandRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BrandContract::class => BrandRepository::class,
        UserContract::class => UserRepository::class,
        CategoryContract::class => CategoryRepository::class,
        FeatureContract::class => FeatureRepository::class,
        FaqContract::class => FaqRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
