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
//Implementation from https://artisansweb.net/how-to-use-laravel-passport-for-rest-api-authentication/

//get product list normally from web app
//http://127.0.0.1:8000/products
//http://127.0.0.1:8000/products/15/reviews

//Action like as other site:
//Login with oauth/token:
//http://127.0.0.1:8000/login_oauth_token

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//get product list normally
Route::Resource('/products','ProductController');
//get product review list normally
Route::Resource('products/{product}/reviews','ReviewController');

//Action like as other site:
//Login with oauth/token:
Route::get('login_oauth_token','OtherSite@login_oauth_token');

//Login with api credentials:
Route::get('login_credentials','OtherSite@login_credentials');

//Product form api with Login:
Route::get('api_products','OtherSite@api_products');
