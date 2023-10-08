<?php

namespace App\Providers;

use App\Contracts\Backend\BrandContract;
use App\Contracts\Backend\CategoryContract;
use App\Contracts\Backend\FaqContract;
use App\Contracts\Backend\FeatureContract;
use App\Contracts\Backend\UserContract;
use App\Contracts\Backend\CountryContract;
use App\Contracts\Backend\StateContract;
use App\Contracts\Backend\CityContract;
use App\Contracts\Backend\AttributeContract;
use App\Contracts\Backend\AttributeValueContract;
use App\Contracts\Backend\PackageContract;
use App\Contracts\Backend\PageContract;
use App\Contracts\Backend\StickerContract;
use App\Contracts\Backend\BlogCategoryContract;
use App\Contracts\Backend\BlogTagContract;
use App\Contracts\Backend\BlogContract;
use App\Contracts\Backend\ProductContract;

//Frontend 
use App\Contracts\Frontend\ProductDetailContract;
use App\Contracts\Frontend\CartContract;


use Illuminate\Support\ServiceProvider;

use App\Repositories\Backend\BrandRepository;
use App\Repositories\Backend\CountryRepository;
use App\Repositories\Backend\StateRepository;
use App\Repositories\Backend\CityRepository;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\FaqRepository;
use App\Repositories\Backend\FeatureRepository;
use App\Repositories\Backend\UserRepository;
use App\Repositories\Backend\AttributeRepository;
use App\Repositories\Backend\AttributeValueRepository;
use App\Repositories\Backend\PackageRepository;
use App\Repositories\Backend\PageRepository;
use App\Repositories\Backend\StickerRepository;
use App\Repositories\Backend\BlogCategoryRepository;
use App\Repositories\Backend\BlogTagRepository;
use App\Repositories\Backend\BlogRepository;
use App\Repositories\Backend\ProductRepository;

//Frontend 
use App\Repositories\Frontend\ProductDetailRepository;
use App\Repositories\Frontend\CartRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BrandContract::class => BrandRepository::class,
        UserContract::class => UserRepository::class,
        CategoryContract::class => CategoryRepository::class,
        FeatureContract::class => FeatureRepository::class,
        FaqContract::class => FaqRepository::class,
        CountryContract::class => CountryRepository::class,
        StateContract::class => StateRepository::class,
        CityContract::class => CityRepository::class,
        AttributeContract::class => AttributeRepository::class,
        AttributeValueContract::class => AttributeValueRepository::class,
        PackageContract::class => PackageRepository::class,
        PageContract::class => PageRepository::class,
        StickerContract::class => StickerRepository::class,
        BlogCategoryContract::class => BlogCategoryRepository::class,
        BlogTagContract::class => BlogTagRepository::class,
        BlogContract::class => BlogRepository::class,
        ProductContract::class => ProductRepository::class,
        ProductDetailContract::class => ProductDetailRepository::class,
        CartContract::class => CartRepository::class,
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
