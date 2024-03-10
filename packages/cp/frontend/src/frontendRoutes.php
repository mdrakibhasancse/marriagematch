<?php
//frontend
Route::group(['middleware' => ['web']], function () {

    Route::get('/', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@welcome',
        'as' => 'welcome'
    ]);

    Route::get('/ajax-welcome', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@lazyloadContent',
        'as' => 'lazyloadContent'
    ]);


    Route::get('/page/{id}/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@page',
        'as' => 'page'
    ]);



    Route::post('/contact-us', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@contactUs',
        'as' => 'contactUs'
    ]);

    Route::get('/blog', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@blog',
        'as' => 'blog'
    ]);

    Route::get('/blog/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@singlePost',
        'as' => 'singlePost'
    ]);

    Route::get('/blog/view-post/{id}/{slug?}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@singlePostWithId',
        'as' => 'singlePostWithId'
    ]);

    Route::get('/blog', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@blog',
        'as' => 'blog'
    ]);


    Route::post('/languages/update/status/{language}', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@languageUpdateStatus',
        'as' => 'languageUpdateStatus'
    ]);


    Route::get('/NilofaMarriageMedia', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@NilofaMarriageMedia',
        'as' => 'NilofaMarriageMedia'
    ]);


    Route::get('/sitemap.xml', [
        'uses' => 'Cp\Frontend\Controllers\FrontendController@sitemap',
        'as' => 'sitemap'
    ]);




});


//admin
Route::group(['middleware' => ['web'], 'prefix' => 'admin'], function () {
});