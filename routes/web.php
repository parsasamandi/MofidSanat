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
Route::get('login','Auth\loginController@index')->name('login');
Route::post('login', 'Auth\LoginController@store');
// Home
Route::get('/','HomeController@index');
// Each Product Description
Route::get('/product/eachProduct/{id}', 'ProductController@each');
// Products With Categories
Route::get('product/products', 'ProductController@get')->name('products');

Route::group(['middleware' => 'auth'], function () {
    // logout
    Route::get('/logout', 'Auth\LoginController@logout');
    // Admin
    Route::get('/adminHome','AdminController@admin');
    Route::group(['prefix' => 'admin','as' => 'admin.'], function() {
        Route::get('list', 'AdminController@list');
        Route::get('table/list', 'AdminController@adminTable')->name('list.table');
        Route::post('store', 'AdminController@store');
        Route::get('edit', 'AdminController@edit');
        Route::get('delete/{id}','AdminController@delete');
    });
    // Product
    Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
        Route::get('list','ProductController@list');
        Route::get('table/list', 'ProductController@productTable')->name('list.table');
        Route::post('store','ProductController@store');
        Route::get('edit', 'ProductController@edit');
        Route::get('delete/{id}','ProductController@delete');
        // Search For Products
        Route::post('search', 'ProductController@search');
    });
    // Categories based on Sub Categories
    Route::get('/subCategory', 'CategoryController@ajax_subCategory');
    // Categories
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('list','CategoryController@list');
        Route::get('table/list','CategoryController@categoryTable')->name('list.table');
        Route::post('store','CategoryController@store');
        Route::get('edit','CategoryController@edit');
        Route::get('delete/{id}', 'CategoryController@delete');
    });
    // Sub Categories
    Route::group(['prefix' => 'subCategory', 'as' => 'subCategory.'], function() {
        Route::get('list','SubCategoryController@list');
        Route::get('table/list','SubCategoryController@subCategoryTable')->name('list.table');
        Route::post('store','SubCategoryController@store');
        Route::get('edit','SubCategoryController@edit');
        Route::get('delete/{id}','SubCategoryController@delete');
    });
    // Aparat
    Route::group(['prefix' => 'aparat', 'as' => 'aparat.'], function () {
        Route::get('list','AparatController@list');
        Route::get('table/list','AparatController@aparatTable')->name('list.table');
        Route::post('store','AparatController@store');
        Route::get('edit','AparatController@edit');
        Route::get('delete/{id}','AparatController@delete');
    });
    // Image
    Route::group(['prefix' => 'image', 'as' => 'image.'], function() {
        Route::get('list','ImageController@list');
        Route::get('table/list','ImageController@imageTable')->name('list.table');
        Route::post('store','ImageController@store');
        Route::get('edit','ImageController@edit');
        Route::get('delete/{id}','ImageController@delete');
    });
    // Phone Numbers
    Route::group(['prefix' => 'phoneNumber', 'as' => 'phoneNumber.'], function() {
        Route::get('list','PhoneNumberController@list');
        Route::get('table/list','PhoneNumberController@phoneNumberTable')->name('list.table');
        Route::get('delete/{id}', 'PhoneNumberController@delete');
        Route::post('store','PhoneNumberController@store');
        Route::get('edit', 'PhoneNumberController@edit');
    });
    // Team
    Route::group(['prefix' => 'team', 'as' => 'team.'], function () {
        Route::get('list','TeamController@list');
        Route::get('table/list','TeamController@teamTable')->name('list.table');
        Route::post('store','TeamController@store');
        Route::get('edit', 'TeamController@edit');
        Route::get('delete/{id}', 'TeamController@delete');
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


