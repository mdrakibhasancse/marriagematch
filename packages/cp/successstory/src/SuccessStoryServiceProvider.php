<?php

namespace Cp\SuccessStory;

use Illuminate\Support\ServiceProvider;

class SuccessStoryServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/successStoryRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/successstory')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/successstory', 'successstory');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'successstory');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'successstory');

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
        $this->app->make('Cp\SuccessStory\Controllers\SuccessStoryController');
        $this->app->make('Cp\SuccessStory\Controllers\AdminSuccessStoryController');


        //config

        $this->mergeConfigFrom(__DIR__ . '/config/su_parameter.php', 'su_parameter');

        $this->mergeConfigFrom(__DIR__ . '/config/successstory.php', 'successstory');
    }
}