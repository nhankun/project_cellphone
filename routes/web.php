<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//ADMIN
Route::prefix('admin')->group(function () {
    //UserManager
    Route::prefix('manager')->group(function () {
        Route::namespace('Backs\Admins\Managers\Users')->group(function () {
            Route::get('users/getDistrict', 'UserController@getDistrictByProvince')->name('manager-user.district');
            Route::resource('users', 'UserController');
        });
        Route::namespace('Backs\Admins\Users')->group(function () {
            Route::resource('admin_users', 'UserController');
        });
    });

});

//MANAGER
Route::prefix('manager')->group(function () {

    //ProviderManager
    Route::namespace('Backs\Managers')->group(function () {
        Route::resource('manager_providers', 'ManagerProviderController');
    });

    Route::namespace('Backs\Providers')->group(function () {
        Route::resource('providers', 'ProviderController');
    });

    //CategoryManager
    Route::namespace('Backs\Managers')->group(function () {
        Route::resource('manager_categories', 'ManagerCategoryController');
    });

    Route::namespace('Backs\Categories')->group(function () {
        Route::resource('categories', 'CategoryController');
    });

    Route::namespace('Backs\Products')->group(function () {
        Route::delete('product/delete/property', 'ProductController@deleteProperty')->name('products.deleteProperty');
        Route::get('products/get-property-by-category', 'ProductController@setPropertyByCategoried')->name('products.getPropertyByCategory');
        Route::resource('products', 'ProductController');

        Route::resource('details', 'DetailController');
    });



});
