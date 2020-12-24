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
Route::get('language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    return back();
})->name('langroute');

Route::group(['middleware'=>['lang']], function(){


    Route::get('/', function () {
        return view('welcome');
    });

    //ADMIN
    Route::group(['middleware'=>['can:admin']],function() {
        Route::prefix('admin')->group(function () {
            //UserManager
            Route::prefix('manage')->group(function () {

                Route::resource('categories', 'Admins\Managers\CategoryController');
                Route::post('categories/approved/{category}', 'Admins\Managers\CategoryController@approved')->name('categories.approved');
                Route::post('categories/cancel/{category}', 'Admins\Managers\CategoryController@cancel')->name('categories.cancel');

                Route::namespace('Admins\Managers')->group(function () {
                    Route::get('users/getDistrict', 'UserController@getDistrictByProvince')->name('manager-user.district');
                    Route::resource('users', 'UserController');
                });
            });

        });
    });


    //MANAGER
    Route::prefix('manage')->group(function () {
        Route::get('/', function (){
            return redirect()->route("dashboard.index");
        });

        Route::namespace('Managers')->group(function () {
            Route::resource('/dashboard', 'DashboardController');

            Route::resource('manager_products', 'ManagerProductController');
            Route::resource('manager_providers', 'ManagerProviderController');
            Route::resource('manufacturers', 'ManufacturerController');
        });

        Route::namespace('Providers')->group(function () {
            Route::resource('providers', 'ProviderController');
        });

        Route::namespace('Products')->group(function () {
            Route::prefix('products')->group(function () {
                Route::delete('delete/property', 'ProductController@deleteProperty')->name('products.deleteProperty');
                Route::get('get-property-by-category', 'ProductController@setPropertyByCategoried')->name('products.getPropertyByCategory');

                Route::get('details/create/{product}', 'ProductController@createProductDetail')->name('details.create');
                Route::post('details/create/{product}', 'ProductController@storeProductDetail')->name('details.store');
                Route::get('details/edit/{product}', 'ProductController@editProductDetail')->name('details.edit');
                Route::put('details/edit/{product}', 'ProductController@updateProductDetail')->name('details.update');
    //            Route::resource('details', 'DetailController');
                Route::resource('images', 'ImageController');
            });
            Route::resource('products', 'ProductController');
        });

    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');


});
