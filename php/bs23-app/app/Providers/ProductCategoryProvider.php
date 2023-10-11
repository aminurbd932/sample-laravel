<?php

namespace App\Providers;

use App\Services\ProductCategoryService;
use Illuminate\Support\ServiceProvider;

class ProductCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductCategoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
