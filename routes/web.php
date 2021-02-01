<?php
use App\Http\Controllers\CategoryController;

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

// Login Page
Route::get('login',[ 'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('login', 'LoginController@store');
// Home
Route::get('/','HomeController@index');
// Each Product Description
Route::get('/product/eachProduct/{id}', 'ProductController@each');
// Products With Categories
Route::get('product/products', 'ProductController@get')->name('products');
// Search For Products
Route::post('/product/search', 'ProductController@search')->name('searchProduct');

Route::group(['middleware' => 'auth'], function () {
    // logout
    Route::get('/logout', 'LoginController@logout');
    // Admin
    Route::get('/adminHome','AdminController@admin');
    Route::group(['prefix' => 'admin','as' => 'admin.'], function() {
        Route::get('list', 'AdminController@list')->name('list');
        Route::get('table/list', 'AdminController@adminTable')->name('list.table');
        Route::post('new', 'AdminController@store')->name('store');
        Route::get('edit', 'AdminController@edit')->name('edit');
        Route::get('delete/{id}','AdminController@delete')->name('delete');
    });
    // Product
    Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
        Route::get('list','ProductController@list')->name('list');
        Route::get('table/list', 'ProductController@productTable')->name('list.table');
        Route::post('new','ProductController@store')->name('store');
        Route::get('edit', 'ProductController@edit')->name('edit');
        Route::get('delete/{id}','ProductController@delete')->name('delete');
    });
    // Categorieslss
    Route::get('/ajax-subcat', 'ProductController@ajax_subcat');
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('list','CategoryController@list')->name('list');
        Route::get('table/list','CategoryController@categoryTable')->name('list.table');
        Route::post('new','CategoryController@store')->name('store');
        Route::get('edit','CategoryController@edit')->name('edit');
        Route::get('delete/{id}', 'CategoryController@delete')->name('delete');
    });
    // Sub Categories
    Route::group(['prefix' => 'subCategory', 'as' => 'subCategory.'], function() {
        Route::get('list','SubCategoryController@list')->name('list');
        Route::get('table/list','SubCategoryController@subCategoryTable')->name('list.table');
        Route::post('new','SubCategoryController@store')->name('store');
        Route::get('edit','SubCategoryController@edit')->name('edit');
        Route::get('delete/{id}','SubCategoryController@delete')->name('delete');
    });
    // Media
        // Aparat
        Route::group(['prefix' => 'aparat', 'as' => 'aparat.'], function () {
            Route::get('list','AparatController@list')->name('list');
            Route::get('table/list','AparatController@aparatTable')->name('list.table');
            Route::post('new','AparatController@store')->name('store');
            Route::get('edit','AparatController@edit')->name('edit');
            Route::get('delete/{id}','AparatController@delete')->name('delete');
        });
        // Image
        Route::group(['prefix' => 'image', 'as' => 'image.'], function() {
            Route::get('list','ImageController@list')->name('list');
            Route::get('table/list','ImageController@imageTable')->name('list.table');
            Route::post('new','ImageController@store')->name('store');
            Route::get('edit','ImageController@edit')->name('edit');
            Route::get('delete/{id}','ImageController@delete')->name('delete');
        });
    // Phone Numbers
    Route::group(['prefix' => 'phoneNumber', 'as' => 'phoneNumber.'], function() {
        Route::get('list','PhoneNumberController@list')->name('list');
        Route::get('table/list','PhoneNumberController@phoneNumberTable')->name('list.table');
        Route::get('delete/{id}', 'PhoneNumberController@delete')->name('delete');
        Route::post('new','PhoneNumberController@store')->name('store');
        Route::get('edit', 'PhoneNumberController@edit')->name('edit');
    });
    // Team
    Route::group(['prefix' => 'team', 'as' => 'team.'], function () {
        Route::get('list','TeamController@index')->name('list');
        Route::get('table/list','TeamController@teamTable')->name('list.table');
        Route::post('new','TeamController@store')->name('store');
        Route::get('edit', 'TeamController@edit')->name('edit');
        Route::get('delete/{id}', 'TeamController@delete')->name('delete');
    });
    // Home Setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
        // Home Setting
        Route::get('homeSetting','HomeSettingController@index')->name('homeSetting');
        Route::post('homeSetting','HomeSettingController@store')->name('storeSetting');
        // Product Setting
        Route::get('productSetting','ProductSettingController@index')->name('productSetting');
        Route::post('productSetting','ProductSettingController@store')->name('storeProduct');
    });
});


