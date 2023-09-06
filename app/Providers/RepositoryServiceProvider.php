<?php

namespace App\Providers;

use App\Contracts\Backend\BrandContract;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Backend\BrandRepository;





class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BrandContract::class => BrandRepository::class,
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
