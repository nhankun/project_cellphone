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

    Route::resource('/dashboard', 'Backs\DashboardController');

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
        Route::prefix('products')->group(function () {
            Route::delete('delete/property', 'ProductController@deleteProperty')->name('products.deleteProperty');
            Route::get('get-property-by-category', 'ProductController@setPropertyByCategoried')->name('products.getPropertyByCategory');

            Route::get('details/create/{product}', 'ProductController@createProductDetail')->name('details.create');
            Route::post('details/create/{product}', 'ProductController@storeProductDetail')->name('details.store');
            Route::get('details/edit/{product}', 'ProductController@editProductDetail')->name('details.edit');
            Route::put('details/edit/{product}', 'ProductController@updateProductDetail')->name('details.update');
//            Route::resource('details', 'DetailController');
        });
        Route::resource('products', 'ProductController');
    });



});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
