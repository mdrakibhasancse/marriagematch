<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/advertisement-space', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdvertisementSpaceController@myAdvertisementspace',
        'as' => 'myAdvertisementspace'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {




    // Advetisment Space route

    Route::get('advertisement/spaces/all', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpacesAll',
        'as' => 'admin.advertisementSpacesAll'
    ]);


    Route::get('advertisement/space/create', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceCreate',
        'as' => 'admin.advertisementSpaceCreate'
    ]);

    Route::post('advertisement/space/store', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceStore',
        'as' => 'admin.advertisementSpaceStore'
    ]);

    Route::get('advertisement/space/edit/{advertisement}', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceEdit',
        'as' => 'admin.advertisementSpaceEdit'
    ]);

    Route::post('advertisement/space/update/{advertisement}', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceUpdate',
        'as' => 'admin.advertisementSpaceUpdate'
    ]);


    Route::post('advertisement/space/{advertisement}', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceDelete',
        'as' => 'admin.advertisementSpaceDelete'
    ]);


    Route::post('advertisement/space/active', [
        'uses' => 'Cp\AdvertisementSpace\Controllers\AdminAdvertisementSpaceController@advertisementSpaceActive',
        'as' => 'admin.advertisementSpaceActive'
    ]);
});
