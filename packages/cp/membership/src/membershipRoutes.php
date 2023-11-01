<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('all-packages', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@allPackages',
        'as' => 'allPackages'
    ]);
    // Route::get('view/package/{package}', [
    //     'uses' => 'Cp\Membership\Controllers\MembershipController@viewPackage',
    //     'as' => 'viewPackage'
    // ]);
});

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'user'], function () {


    Route::get('/new/profile/create', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileCreate',
        'as' => 'user.newProfileCreate'
    ]);

    Route::get('new/profile/for', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileFor',
        'as' => 'user.newProfileFor'
    ]);

    Route::post('new/profile/for/store', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileForStore',
        'as' => 'user.newProfileForStore'
    ]);


    Route::get('new/profile/next/step', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileNextStep',
        'as' => 'user.newProfileNextStep'
    ]);


    Route::post('new/profile/next/step/store', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileNextStepStore',
        'as' => 'user.newProfileNextStepStore'
    ]);

    Route::post('new/profile/education/store', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileEducationStore',
        'as' => 'user.newProfileEducationStore'
    ]);

    Route::get('new/profile/education/edit', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileEducationEdit',
        'as' => 'user.newProfileEducationEdit'
    ]);

    Route::post('new/profile/education/update', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileEducationUpdate',
        'as' => 'user.newProfileEducationUpdate'
    ]);


    Route::get('new/profile/education/delete/{edu}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileEducationDelete',
        'as' => 'user.newProfileEducationDelete'
    ]);


    Route::post('new/profile/relative/store', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileRelativeStore',
        'as' => 'user.newProfileRelativeStore'
    ]);



    Route::get('new/profile/relative/edit', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileRelativeEdit',
        'as' => 'user.newProfileRelativeEdit'
    ]);

    Route::post('new/profile/relative/update', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileRelativeUpdate',
        'as' => 'user.newProfileRelativeUpdate'
    ]);

    Route::get('new/profile/relative/delete/{relative}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newProfileRelativeDelete',
        'as' => 'user.newProfileRelativeDelete'
    ]);


    Route::post('new/profile/partner/preference/store', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@marriagePartnerPreference',
        'as' => 'user.marriagePartnerPreference'
    ]);


    Route::get('new/user/end/partner/preference/create', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@newUserEndPartnerPreference',
        'as' => 'user.newUserEndPartnerPreference'
    ]);

    Route::get('information/update', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@informationUpdate',
        'as' => 'user.informationUpdate'
    ]);


    Route::post('cv/picture/upload', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@cvPictureUpload',
        'as' => 'user.cvPictureUpload'
    ]);


    Route::get('profile/info/update', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@profileInfoUpdate',
        'as' => 'membership.profileInfoUpdate'
    ]);

    Route::get('view/profile/{user}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@viewProfile',
        'as' => 'membership.viewProfile'
    ]);

    Route::get('favourite/{user}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@favouriteProfile',
        'as' => 'membership.favouriteProfile'
    ]);

    Route::get('contact/{user}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@contactProfile',
        'as' => 'membership.contactProfile'
    ]);



    Route::post('package/order/{package}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@packageOrder',
        'as' => 'membership.packageOrder'
    ]);

    Route::get('view/package/{package}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@viewPackage',
        'as' => 'viewPackage'
    ]);



    Route::get('my/type/{type?}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@myProfileDetails',
        'as' => 'membership.myProfileDetails'
    ]);

    Route::get('proposal/modal/user/{user}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@proposalModal',
        'as' => 'membership.proposalModal'
    ]);

    Route::post('proposal/send/{user}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@proposalSend',
        'as' => 'membership.proposalSend'
    ]);

    Route::get('proposal/accept/{proposal}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@proposalAccept',
        'as' => 'membership.proposalAccept'
    ]);

    Route::any('proposal/delete/{proposal}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@proposalDelete',
        'as' => 'membership.proposalDelete'
    ]);

    Route::get('message/dashboard/{userto?}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@messageDashboard',
        'as' => 'membership.messageDashboard'
    ]);

    Route::post('message/dashboard/post/{userto}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@messageDashboardPost',
        'as' => 'membership.messageDashboardPost'
    ]);

    Route::get('my/orders', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@myOrders',
        'as' => 'membership.myOrders'
    ]);

    Route::get('my/order/details/{order}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@myOrderDeatils',
        'as' => 'membership.myOrderDeatils'
    ]);

    Route::get('my/cancel/order/{order}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@cancelMyOrder',
        'as' => 'membership.cancelMyOrder'
    ]);


    

    Route::get('my/invoice/print/{order}', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@myOrderPrint',
        'as' => 'membership.myOrderPrint'
    ]);


    Route::get('profile/search', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@profileSearch',
        'as' => 'membership.profileSearch'
    ]);

     Route::get('profile/search/result', [
        'uses' => 'Cp\Membership\Controllers\MembershipController@profileSearchResult',
        'as' => 'membership.profileSearchResult'
    ]);
});


//admin
Route::group(['middleware' => ['web', 'auth', 'role:admin|user_manage'], 'prefix' => 'admin'], function () {



    Route::get('message/users/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@messageUsers',
        'as' => 'admin.messageUsers'
    ]);

    Route::get('conversations/details/Of/users', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@conversationsDetailsOfUsers',
        'as' => 'admin.conversationsDetailsOfUsers'
    ]);




    //Profile Category Route Start

    Route::get('profile/categories/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoriesAll',
        'as' => 'admin.profileCategoriesAll'
    ]);


    Route::get('profile/category/create', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoryCreate',
        'as' => 'admin.profileCategoryCreate'
    ]);

    Route::post('profile/category/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoryStore',
        'as' => 'admin.profileCategoryStore'
    ]);

    Route::get('profile/category/edit/category/{category}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoryEdit',
        'as' => 'admin.profileCategoryEdit'
    ]);

    Route::post('profile/category/update/category/{category}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoryUpdate',
        'as' => 'admin.profileCategoryUpdate'
    ]);


    Route::post('profile/category/delete/category/{category}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoryDelete',
        'as' => 'admin.profileCategoryDelete'
    ]);


    Route::post('profile/category/active', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCategoryActive',
        'as' => 'admin.profileCategoryActive'
    ]);

    //Profile Category Route End

    //Profile SubCategory Route start

    Route::get('profile/subCategories/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoriesAll',
        'as' => 'admin.profileSubCategoriesAll'
    ]);

    Route::get('profile/subCategory/create', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoryCreate',
        'as' => 'admin.profileSubCategoryCreate'
    ]);

    Route::post('profile/subCategory/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoryStore',
        'as' => 'admin.profileSubCategoryStore'
    ]);

    Route::get('profile/subCategory/edit/subCategory/{subCategory}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoryEdit',
        'as' => 'admin.profileSubCategoryEdit'
    ]);

    Route::post('profile/subCategory/update/subCategory/{subCategory}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoryUpdate',
        'as' => 'admin.profileSubCategoryUpdate'
    ]);

    Route::post('profile/subCategory/delete/subCategory/{subCategory}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoryDelete',
        'as' => 'admin.profileSubCategoryDelete'
    ]);

    Route::post('profile/subCategory/active', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSubCategoryActive',
        'as' => 'admin.profileSubCategoryActive'
    ]);

    //Profile SubCategory Route End

    //Profile Religion Route Start
    Route::get('profile/religions/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileReligionsAll',
        'as' => 'admin.profileReligionsAll'
    ]);

    Route::post('profile/religion/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileReligionStore',
        'as' => 'admin.profileReligionStore'
    ]);

    Route::get('profile/religion/edit/{religion}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileReligionEdit',
        'as' => 'admin.profileReligionEdit'
    ]);

    Route::post('profile/religion/update/{religion}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileReligionUpdate',
        'as' => 'admin.profileReligionUpdate'
    ]);

    Route::post('profile/religion/delete/{religion}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileReligionDelete',
        'as' => 'admin.profileReligionDelete'
    ]);


    Route::get('profile/casts/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCastsAll',
        'as' => 'admin.profileCastsAll'
    ]);

    Route::post('profile/cast/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCastStore',
        'as' => 'admin.profileCastStore'
    ]);

    Route::get('profile/cast/edit/{cast}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCastEdit',
        'as' => 'admin.profileCastEdit'
    ]);

    Route::post('profile/cast/update/{cast}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCastUpdate',
        'as' => 'admin.profileCastUpdate'
    ]);

    Route::post('profile/cast/delete/{cast}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileCastDelete',
        'as' => 'admin.profileCastDelete'
    ]);

    //Profile Religion Route End


    //Profile Setting Field Route Start

    Route::get('profile/setting/fields/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingFieldsAll',
        'as' => 'admin.profileSettingFieldsAll'
    ]);

    Route::post('profile/setting/field/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingFieldStore',
        'as' => 'admin.profileSettingFieldStore'
    ]);

    Route::get('profile/setting/field/edit/{field}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingFieldEdit',
        'as' => 'admin.profileSettingFieldEdit'
    ]);

    Route::post('profile/setting/field/update/{field}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingFieldUpdate',
        'as' => 'admin.profileSettingFieldUpdate'
    ]);

    Route::post('profile/setting/field/delete/{field}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingFieldDelete',
        'as' => 'admin.profileSettingFieldDelete'
    ]);


    Route::get('profile/setting/values/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingValuesAll',
        'as' => 'admin.profileSettingValuesAll'
    ]);

    Route::post('profile/setting/value/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingValueStore',
        'as' => 'admin.profileSettingValueStore'
    ]);

    Route::get('profile/setting/value/edit/{value}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingValueEdit',
        'as' => 'admin.profileSettingValueEdit'
    ]);

    Route::post('profile/setting/value/update/{value}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingValueUpdate',
        'as' => 'admin.profileSettingValueUpdate'
    ]);

    Route::post('profile/setting/value/delete/{value}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileSettingValueDelete',
        'as' => 'admin.profileSettingValueDelete'
    ]);

    //Profile Setting Field Route End

    //profile parameter Route Start

    Route::get('profile/parameters/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileParametersAll',
        'as' => 'admin.profileParametersAll'
    ]);

    Route::post('profile/parameter/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileParameterStore',
        'as' => 'admin.profileParameterStore'
    ]);

    Route::get('profile/parameter/edit/{parameter}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileParameterEdit',
        'as' => 'admin.profileParameterEdit'
    ]);

    Route::post('profile/parameter/update/{parameter}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileParameterUpdate',
        'as' => 'admin.profileParameterUpdate'
    ]);

    Route::post('profile/parameter/delete/{parameter}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@profileParameterDelete',
        'as' => 'admin.profileParameterDelete'
    ]);

    //profile parameter route end


    //Membership packages route Start

    Route::get('packages/all', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@packagesAll',
        'as' => 'admin.packagesAll'
    ]);


    Route::get('package/create', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@packageCreate',
        'as' => 'admin.packageCreate'
    ]);

    Route::post('package/store', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@packageStore',
        'as' => 'admin.packageStore'
    ]);

    Route::get('package/edit/{package}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@packageEdit',
        'as' => 'admin.packageEdit'
    ]);

    Route::post('package/update/{package}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@packageUpdate',
        'as' => 'admin.packageUpdate'
    ]);


    Route::post('package/delete/{package}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@packageDelete',
        'as' => 'admin.packageDelete'
    ]);

    Route::post('package/update/for/admin/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@pacakgeUpdateForAdmin',
        'as' => 'admin.pacakgeUpdateForAdmin'
    ]);








    //Membership packages route end

    Route::get('orders/all/type/{type?}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@ordersAll',
        'as' => 'admin.ordersAll'
    ]);


    Route::get('order/details/{order}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@orderDeatils',
        'as' => 'admin.orderDeatils'
    ]);


    Route::post('order/payment/{order}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@orderPayment',
        'as' => 'admin.orderPayment'
    ]);

    Route::post('order/status/{order}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@orderStatus',
        'as' => 'admin.orderStatus'
    ]);


    Route::post('order/delete/{order}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@orderDelete',
        'as' => 'admin.orderDelete'
    ]);

    Route::get('invoice/print/{order}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@orderPrint',
        'as' => 'admin.orderPrint'
    ]);




    //Membership oreders route start


    //Membership oreders route end


    Route::post('user/info/update/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@userInfoUpdate',
        'as' => 'admin.userInfoUpdate'
    ]);


    Route::post('user/setting/profile/pic/change/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@userSettingProfilePicChange',
        'as' => 'admin.userSettingProfilePicChange'
    ]);

    Route::post('marriage/info/post/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@marriageInfoPost',
        'as' => 'admin.marriageInfoPost'
    ]);

    Route::post('education/info/store/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@newProfileEducationStore',
        'as' => 'admin.newProfileEducationStore'
    ]);

    Route::get('education/info/edit', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@newProfileEducationEdit',
        'as' => 'admin.newProfileEducationEdit'
    ]);

    Route::post('education/info/update', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@newProfileEducationUpdate',
        'as' => 'admin.newProfileEducationUpdate'
    ]);



    Route::get('education/info/delete/{edu}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@newProfileEducationDelete',
        'as' => 'admin.newProfileEducationDelete'
    ]);


    Route::get('new/user/profile/create/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@newUserProfileCreate',
        'as' => 'admin.newUserProfileCreate'
    ]);



    Route::post('relative/info/store/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@relativeInfoStore',
        'as' => 'admin.relativeInfoStore'
    ]);

    Route::get('relative/info/edit', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@relativeInfoEdit',
        'as' => 'admin.relativeInfoEdit'
    ]);

    Route::post('relative/info/update', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@relativeInfoUpdate',
        'as' => 'admin.relativeInfoUpdate'
    ]);

    Route::get('relative/info/delete/{relative}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@relativeInfoDelete',
        'as' => 'admin.relativeInfoDelete'
    ]);



    Route::get('new/user/partner/preference/create/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@newUserPartnerPreference',
        'as' => 'admin.newUserPartnerPreference'
    ]);


    Route::post('partner/preference/info/store/{user}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@partnerPreferenceInfoStore',
        'as' => 'admin.partnerPreferenceInfoStore'
    ]);


    Route::post('user/action/user/{user}/action/{action}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@userAction',
        'as' => 'admin.userAction'
    ]);


    Route::post('setting/profile/post/user/{user}/type/{type}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@settingProfilePost',
        'as' => 'admin.settingProfilePost'
    ]);


    Route::get('user/cv/picture/pictures', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@userCvPictures',
        'as' => 'admin.userCvPictures'
    ]);

    Route::get('create/cv/picture/profile/store/{picture}', [
        'uses' => 'Cp\Membership\Controllers\AdminMembershipController@createCvPictureProfileStore',
        'as' => 'admin.createCvPictureProfileStore'
    ]);
});