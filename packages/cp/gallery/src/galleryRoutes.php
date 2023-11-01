<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('my/gallery', [
        'uses' => 'Cp\Gallery\Controllers\GalleryController@myGallery',
        'as' => 'myGallery'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {

    // media route

    Route::get('galleries/all', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleriesAll',
        'as' => 'admin.galleriesAll'
    ]);

    Route::get('gallery/create', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryCreate',
        'as' => 'admin.galleryCreate'
    ]);

    Route::post('gallery/store', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryStore',
        'as' => 'admin.galleryStore'
    ]);

    Route::get('gallery/edit/{gallery}', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryEdit',
        'as' => 'admin.galleryEdit'
    ]);

    Route::post('gallery/update/{gallery}', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryUpdate',
        'as' => 'admin.galleryUpdate'
    ]);

    Route::post('gallery/delete/{gallery}', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryDelete',
        'as' => 'admin.galleryDelete'
    ]);


    Route::get('gallery/item/delete/{imageItem}', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryImageItemDelete',
        'as' => 'admin.galleryImageItemDelete'
    ]);

    Route::get('gallery/item/description/{imageItem}', [
        'uses' => 'Cp\Gallery\Controllers\AdminGalleryController@galleryItemDescriptionUpdate',
        'as' => 'admin.galleryItemDescriptionUpdate'
    ]);
});