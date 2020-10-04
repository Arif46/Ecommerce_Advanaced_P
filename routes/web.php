<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
    Route::match(['get','post'],'/','AdminController@login');
    Route::group(['middleware' =>['admin']],function(){

        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::get('logout','AdminController@logout');
        Route::post('check_current_pwd','AdminController@checkcurrentpassword');
        Route::post('update_current_pwd','AdminController@updatecurrentpassword');
        Route::match(['get','post'],'update-admin-details','AdminController@UpdateAdminDetails');

        //Sections
        Route::get('sections','SectionController@sections');
        Route::post('update-section-status','SectionController@UpdateSectionStatus');
        
        //Categories
        Route::get('categories','CategoryController@categories');
        Route::post('update-category-status','CategoryController@UpdateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addeditcategory');
        Route::post('append-categories-level','CategoryController@appendCategoryLevel');
        Route::get('delete-category/{id}','CategoryController@deletecategory');
        
        //products
        Route::get('Products','ProductController@products');
        Route::post('update-product-status','ProductController@UpdateProductStatus');
        Route::get('delete-product/{id}','ProductController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductController@addeditproduct');
    });
    

});
