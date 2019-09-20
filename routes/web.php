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
//Route::get('/', function () {
//    return redirect('login');
//});

Auth::routes();

//routes of admin panal
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
    Route::group(['middleware'=>['auth:web','auto-check-permission']],function(){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('post', 'PostController');
        Route::resource('categorie', 'CategoryController');
        Route::resource('governorate', 'GovernorateController');
        Route::resource('city', 'CityController');
        Route::resource('client', 'ClientController');
        Route::get('clients/{id}/activated', 'ClientController@activated');
        Route::get('clients/{id}/deactivated', 'ClientController@deactivated');
        Route::resource('order', 'OrderController');
        Route::resource('contact', 'ContactController');
        Route::resource('setting', 'SettingController');
        Route::get('user/change-password','UserController@changePassword');
        Route::post('user/change-password','UserController@changePasswordSave');
        Route::resource('user', 'UserController');
        Route::resource('role', 'RoleController');
        Route::resource('permission', 'PermissionController');
    });
});
Route::get('forgetpassword','UserController@forgetpassword');
Route::post('forgetpassword','UserController@passwordSave')->name('savepassword');

//=========================================================================================

//routes of web applicatin

    //route from bloodbank home
    Route::get('/', 'DesignController@home');
    //route from order details
    Route::get('/order/details/{id}/', 'DesignController@order')->name('order.details');
    //route to show all orders
    Route::get('/orders', 'DesignController@orders')->name('orders');
    Route::get('/posts/{id}/', 'DesignController@post')->name('posts');
    Route::get('/about', 'DesignController@about')->name('about');
    Route::get('/contacts', 'DesignController@contact')->name('contacts');
    Route::post('create/contact', 'DesignController@createContact')->name('create.contact');
    Route::get('/register', 'DesignController@register');
    Route::post('create/client', 'DesignController@createClient')->name('create.client');
    Route::get('/signin', 'DesignController@signIn')->name('signin');
    Route::post('/signin/checked', 'DesignController@checked')->name('signin.checked');

    //route from reset password
    Route::get('/resetpassword', 'DesignController@resetPassword')->name('resetpassword');
    Route::post('reset-password','DesignController@ressetpassword')->name('reset-password');
    //route from new password
    Route::get('/newpassword', 'DesignController@newPassword')->name('newpassword');
    Route::post('new-password','DesignController@neewpassword')->name('new-password');


    Route::group(['middleware' => 'auth:client_web'], function () {
        Route::get('/order/create', 'DesignController@orderCreate')->name('order.create');
        Route::post('/order/store','DesignController@orderStore')->name('order.store');
    });










