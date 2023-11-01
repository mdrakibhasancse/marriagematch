<?php

namespace App\Providers;

use Cp\BlogPost\Models\BlogPost;
use Cp\Membership\Models\ProfileParameter;
use Cp\Menupage\Models\Menu;
use Cp\Menupage\Models\Page;
use Cp\WebsiteSetting\Models\WebsiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $seconds = 86400; //24 hours

            $headerMenus = cache()->remember('headerMenus', $seconds, function () {
                return Menu::whereActive(true)->where('type', 'header_menu')->orderBy('drag_id')->latest()->get();
            });
            View::share('headerMenus', $headerMenus);

            $footerMenus = cache()->remember('footerMenus', $seconds, function () {
                return Menu::whereActive(true)->where('type', 'footer_menu')->orderBy('drag_id')->latest()->get();
            });
            View::share('footerMenus', $footerMenus);



            $popular_posts =  cache()->remember('popular_posts', $seconds, function () {
                return BlogPost::orderBy('view_count', 'DESC')->whereActive(true)->whereStatus('published')->take(6)->get();
            });
            View::share('popular_posts', $popular_posts);

            $homePage =  cache()->remember('homePage', $seconds, function () {
                return Page::whereActive(true)->where('id', 1)->first();
            });
            View::share('homePage', $homePage);


            $contactUsPage =  cache()->remember('contactUsPage', $seconds, function () {
                return Page::whereActive(true)->where('id', 2)->first();
            });

            View::share('contactUsPage', $contactUsPage);

            $ws =  cache()->remember('ws', $seconds, function () {
                return WebsiteSetting::first();
            });
            View::share('ws', $ws);

            $parameters = cache()->remember('parameters', $seconds, function () {
                return ProfileParameter::groupBy('field_name')
                    ->orderBy('field_name')->get();
            });
            View::share('parameters', $parameters);
        });

        paginator::useBootstrap();
    }
}
