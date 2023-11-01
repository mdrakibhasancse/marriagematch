<?php

namespace Cp\AdvertisementSpace;

use Illuminate\Support\ServiceProvider;

class AdvertisementSpaceServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/advertisementSpaceRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/advertisementspace')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/advertisementspace', 'advertisementspace');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'advertisementspace');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'advertisementspace');

        // $this->publishes([
        //     __DIR__.'/lang' => $this->app->langPath('vendor/menupage'),
        // ]);


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //controller
        $this->app->make('Cp\AdvertisementSpace\Controllers\AdvertisementSpaceController');
        $this->app->make('Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/advertisementspace.php', 'advertisementspace');

        $this->mergeConfigFrom(__DIR__ . '/config/ad_parameter.php', 'ad_parameter');
    }
}
