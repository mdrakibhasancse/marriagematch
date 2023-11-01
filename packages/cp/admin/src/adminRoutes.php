<?php
//admin route 
use Illuminate\Support\Facades\Artisan;

Route::group(['middleware' => ['web', 'auth', 'role:admin|user_manage|menu_&_page_manage|story_&_blog_manage'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', [
        'uses' => 'Cp\Admin\Controllers\AdminController@dashboard',
        'as' => 'admin.dashboard'
    ]);

    Route::get('languages', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languages',
        'as' => 'admin.languages'
    ]);

    Route::get('language/create', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageCreate',
        'as' => 'admin.languageCreate'
    ]);

    Route::post('language/store', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageStore',
        'as' => 'admin.languageStore'
    ]);

    Route::get('language/edit/{language}', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageEdit',
        'as' => 'admin.languageEdit'
    ]);

    Route::post('language/update/{language}', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageUpdate',
        'as' => 'admin.languageUpdate'
    ]);

    Route::post('language/delete/{language}', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageDelete',
        'as' => 'admin.languageDelete'
    ]);

    Route::post('language/status', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageStatus',
        'as' => 'admin.languageStatus'
    ]);


    Route::get('translations', [
        'uses' => 'Cp\Admin\Controllers\AdminController@translations',
        'as' => 'admin.translations'
    ]);

    Route::post('translation/store', [
        'uses' => 'Cp\Admin\Controllers\AdminController@translationStore',
        'as' => 'admin.translationStore'
    ]);

    


    Route::get('language/translations/{language}', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageTranslatoins',
        'as' => 'admin.languageTranslatoins'
    ]);

    Route::post('language/translation/value/store', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageTranslateValueStore',
        'as' => 'admin.languageTranslateValueStore'
    ]);

    Route::get('language/translation/search/ajax', [
        'uses' => 'Cp\Admin\Controllers\AdminController@languageTranlationSearchAjax',
        'as' => 'admin.languageTranlationSearchAjax'
    ]);

    Route::post('env_key_update', [
        'uses' => 'Cp\Admin\Controllers\AdminController@envKeyUpdate',
        'as' => 'admin.envKeyUpdate'
    ]);


    Route::get('image', function () {
        Artisan::call('storage:link');
        return back();
    });

    Route::get('/clear', function () {
        Artisan::call('optimize:clear');
        return back();
    })->name('clear_cache');
});