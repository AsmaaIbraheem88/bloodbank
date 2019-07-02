<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace'=>'Api'],function(){

	Route::post('register','AuthController@register');

	Route::post('login','AuthController@login');

	Route::post('reset-password','AuthController@ResetPassword');

	Route::post('change-password','AuthController@ChangePassword');

    
	Route::get('governorates','MainController@governorates');

	Route::get('cities','MainController@cities');

	Route::get('blood-types','MainController@bloodTypes');

	

	Route::get('categories','MainController@categories');

	
	
   
	////////////////////////////////////////////////////////////

	Route::group(['middleware' => 'auth:api'],function(){

		Route::get('notifications','MainController@notifications');

		Route::get('notifications-count','MainController@notificationsCount');

		Route::post('notifications-settings','AuthController@notificationsSettings');


		Route::get('posts','MainController@posts');

		Route::get('post','MainController@post');

		Route::get('my-favourites','MainController@myFavourites');

		Route::get('post-toggle-favourite','MainController@postToggleFavourite');


	    Route::post('donation-request/create','MainController@donationRequestCreate');

		Route::get('donation-request','MainController@donationRequest');

		Route::get('donation-requests','MainController@donationRequests');


		Route::post('profile','AuthController@profile');

		Route::post('contact','MainController@contactSaveData');

		Route::get('settings','MainController@settings');

		Route::post('register-token','AuthController@registerToken');

		Route::post('remove-token','AuthController@removeToken');
		
	});

	////////////////////////////////////////////////////////////

});

