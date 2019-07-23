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
    return redirect('login');
});

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
    Route::group(['middleware'=>['auth','auto-check-permission']],function(){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('governorate', 'GovernorateController');
        Route::resource('city', 'CityController');
        Route::resource('categorie', 'CategoryController');
        Route::resource('post', 'PostController');
        Route::resource('client', 'ClientController');
        Route::resource('order', 'OrderController');
        Route::resource('contact', 'ContactController');
        Route::resource('setting', 'SettingController');

        Route::get('clients/{id}/activated', 'ClientController@activated');
        Route::get('clients/{id}/deactivated', 'ClientController@deactivated');


        // User reset password
        Route::get('user/change-password','UserController@changePassword');
        Route::post('user/change-password','UserController@changePasswordSave');
        Route::resource('user', 'UserController');

        Route::resource('role', 'RoleController');
        Route::resource('permission', 'PermissionController');

    });

    Route::get('forgetpassword','UserController@forgetpassword');
    Route::post('forgetpassword','UserController@passwordSave')->name('savepassword');

});



