<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//get product list normally from web app
//http://127.0.0.1:8000/products
//http://127.0.0.1:8000/products/15/reviews

//Action like as other site:
//Login with oauth/token:
//http://127.0.0.1:8000/login_oauth_token

// Create token with Login api using credentials
Route::post('login', 'Api\Auth\LoginController@login');
// Create token with register user
Route::post('register', 'Api\Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function() {
    //product CRUD through api
    Route::apiResource('/products','Api\ProductController');

    //product review CRUD through api
	Route::apiResource('products/{product}/reviews','Api\ReviewController');

    //get logout from api
    Route::get('logout', 'Api\Auth\LoginController@logout');
});
