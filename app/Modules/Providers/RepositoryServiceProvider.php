<?php

namespace App\Modules\Providers;

use App\Modules\Repositories\Brands\BrandRepository;
use App\Modules\Repositories\Brands\BrandRepositoryEloquent;
use App\Modules\Repositories\Users\UserRepository;
use App\Modules\Repositories\Users\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
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
