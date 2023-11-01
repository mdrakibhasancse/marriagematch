<?php

namespace Cp\BlogPost;

use Illuminate\Support\ServiceProvider;

class BlogPostServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/blogPostRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/blogpost')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/blogpost', 'blogpost');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'blogpost');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'blogpost');

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
        $this->app->make('Cp\BlogPost\Controllers\BlogPostController');
        $this->app->make('Cp\BlogPost\Controllers\AdminBlogPostController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/blogpost.php', 'blogpost');
    }
}