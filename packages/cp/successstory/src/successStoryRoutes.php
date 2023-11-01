<?php
Route::group(['middleware' => ['web']], function () {

    Route::get('view-story/{id}', [
        'uses' => 'Cp\SuccessStory\Controllers\SuccessStoryController@viewStory',
        'as' => 'viewStory'
    ]);

    Route::get('all-stories', [
        'uses' => 'Cp\SuccessStory\Controllers\SuccessStoryController@allStories',
        'as' => 'allStories'
    ]);

    Route::get('all-testimonials', [
        'uses' => 'Cp\SuccessStory\Controllers\SuccessStoryController@allTestimonials',
        'as' => 'allTestimonials'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin|menu_&_page_manage|story_&_blog_manage'], 'prefix' => 'admin'], function () {

    // Success Story route

    Route::get('stories/all', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@storiesAll',
        'as' => 'admin.storiesAll'
    ]);


    Route::get('testimonials/all', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@testimonialsAll',
        'as' => 'admin.testimonialsAll'
    ]);


    Route::get('success-story/create', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@successStoryCreate',
        'as' => 'admin.successStoryCreate'
    ]);

    Route::post('success-story/store', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@successStoryStore',
        'as' => 'admin.successStoryStore'
    ]);

    Route::get('success-story/edit/success-story/{story}', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@successStoryEdit',
        'as' => 'admin.successStoryEdit'
    ]);


    Route::post('success-story/update/success-story/{story}', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@successStoryUpdate',
        'as' => 'admin.successStoryUpdate'
    ]);

    Route::post('success-story/delete/success-story/{story}', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@successStoryDelete',
        'as' => 'admin.successStoryDelete'
    ]);

    Route::post('success-story/active', [
        'uses' => 'Cp\SuccessStory\Controllers\AdminSuccessStoryController@successStoryActive',
        'as' => 'admin.successStoryActive'
    ]);
});
