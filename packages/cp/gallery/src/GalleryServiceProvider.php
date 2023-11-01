<?php

namespace Cp\Gallery;

use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/galleryRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/gallery')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/gallery', 'slidergallery');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'gallery');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'gallery');

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
        $this->app->make('Cp\Gallery\Controllers\GalleryController');
        $this->app->make('Cp\Gallery\Controllers\AdminGalleryController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/gallery.php', 'gallery');
    }
}
