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
Route::group(['prefix' => 'v1','namespace' => 'Api'],function (){
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('reset-password','AuthController@resetPassword');
    Route::post('new-password','AuthController@newPassword');
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::get('categories','MainController@categories');
    Route::get('blood-types','MainController@bloodTypes');
    Route::get('settings','MainController@settings');
    Route::post('contacts','MainController@contacts');
    Route::get('notifications','MainController@notifications');
    Route::get('all-orders','MainController@allOrders');
    
    Route::group(['middleware' => 'auth:api'],function (){
      Route::post('profile','AuthController@profile');
      Route::get('posts','MainController@posts');
      Route::post('orders','MainController@orders');
      Route::post('favourites','MainController@favourites');
      Route::post('register-token','AuthController@registerToken');
      Route::post('remove-token','AuthController@removeToken');
      Route::get('notification-count','MainController@notificationCount');
      Route::post('notification-read','MainController@notificationRead');
      Route::post('notification-settings','MainController@notificationSettings');
      Route::get('get-notification-settings','MainController@getNotificationSettings');
      
    });
});


