<?php

namespace App\Providers;

use App\Models\Cat;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use View;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $vars['cats'] = Cat::select('name','id')->get();
        $vars['products'] = Product::all();

        View::share($vars); 
    }
}
