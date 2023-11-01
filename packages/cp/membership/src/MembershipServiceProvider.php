<?php

namespace Cp\Membership;

use Illuminate\Support\ServiceProvider;

class MembershipServiceProvider extends ServiceProvider
{
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages


    public function boot()
    {
        //routes.php
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/membershipRoutes.php';
        }

        //views
        if (is_dir(base_path() . '/resources/views/cp/membership')) {
            $this->loadViewsFrom(base_path() . '/resources/views/cp/membership', 'membership');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'membership');
        }


        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');



        $this->loadTranslationsFrom(__DIR__ . '/lang', 'membership');

        // $this->publishes([
        //     __DIR__.'/lang' => $this->app->langPath('vendor/membership'),
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
        $this->app->make('Cp\Membership\Controllers\MembershipController');
        $this->app->make('Cp\Membership\Controllers\AdminMembershipController');


        //config
        $this->mergeConfigFrom(__DIR__ . '/config/membership.php', 'membership');

        $this->mergeConfigFrom(__DIR__ . '/config/m_parameter.php', 'm_parameter');
    }
}