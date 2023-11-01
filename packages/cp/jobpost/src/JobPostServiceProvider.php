<?php

namespace Cp\JobPost;

use Illuminate\Support\ServiceProvider;

class JobPostServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/jobPostRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/jobpost')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/jobpost', 'jobpost');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'jobpost');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'jobpost');

        // $this->publishes([
        //     __DIR__.'/lang' => $this->app->langPath('vendor/jobpost'),
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
        $this->app->make('Cp\JobPost\Controllers\JobPostController');
        $this->app->make('Cp\JobPost\Controllers\AdminJobPostController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/jobpost.php', 'jobpost');
    }
}