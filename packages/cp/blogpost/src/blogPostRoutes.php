<?php
//menupage //menu & page
Route::group(['middleware' => ['web']], function () {

    Route::get('my/blog-post', [
        'uses' => 'Cp\BlogPost\Controllers\BlogPostController@myBlogPost',
        'as' => 'myBlogPost'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin|menu_&_page_manage|story_&_blog_manage'], 'prefix' => 'admin'], function () {


    Route::get('blog/categories/all', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoriesAll',
        'as' => 'admin.blogCategoriesAll'
    ]);


    Route::get('blog/category/create', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryCreate',
        'as' => 'admin.blogCategoryCreate'
    ]);

    Route::post('blog/category/store', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryStore',
        'as' => 'admin.blogCategoryStore'
    ]);

    Route::get('blog/category/edit/category/{category}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryEdit',
        'as' => 'admin.blogCategoryEdit'
    ]);

    Route::post('blog/category/update/category/{category}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryUpdate',
        'as' => 'admin.blogCategoryUpdate'
    ]);


    Route::post('blog/category/delete/category/{category}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryDelete',
        'as' => 'admin.blogCategoryDelete'
    ]);


    Route::post('blog/category/active', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogCategoryActive',
        'as' => 'admin.blogCategoryActive'
    ]);





    // blog-post route

    Route::get('blog-posts/all', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostsAll',
        'as' => 'admin.blogPostsAll'
    ]);



    Route::get('blog-post/create', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostCreate',
        'as' => 'admin.blogPostCreate'
    ]);

    Route::post('blog-post/store', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostStore',
        'as' => 'admin.blogPostStore'
    ]);

    Route::get('blog-post/edit/blog-post/{blogPost}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostEdit',
        'as' => 'admin.blogPostEdit'
    ]);


    Route::post('blog-post/update/blog-post/{blogPost}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostUpdate',
        'as' => 'admin.blogPostUpdate'
    ]);

    Route::post('blog-post/delete/blog-post/{blogPost}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostDelete',
        'as' => 'admin.blogPostDelete'
    ]);

    Route::get('post/file/delete/{file}', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@postFileDelete',
        'as' => 'admin.postFileDelete'
    ]);


    Route::post('blog-post/active', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@blogPostActive',
        'as' => 'admin.blogPostActive'
    ]);

    Route::get('select/tags', [
        'uses' => 'Cp\BlogPost\Controllers\AdminBlogPostController@selectTags',
        'as' => 'admin.tags'
    ]);
});