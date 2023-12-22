<?php

namespace App\Providers;

use App\Interfaces\DishesInterface;
use App\Services\DishesService;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DishesInterface::class, DishesService::class);
    }
}
