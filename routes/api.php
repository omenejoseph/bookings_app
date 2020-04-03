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

//Route::middleware('auth:api')->post('v1/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['middleware' => ['api'], 'prefix' => '/v1'], function (){
    //UNAUTHENTICATED ROUTES
    Route::post('/login', 'UserController@login')->name('jwt-login');
    Route::post('/logout', 'UserController@logOut')->name('jwt-logout');

    Route::post('user', 'UserController@store')->name('create-user');
});

//AUTHENTICATED ROUTES
Route::group(['middleware' => ['api', 'validateToken'], 'prefix' => '/v1'], function(){
    Route::get('/get-auth-user', 'UserController@getAuthUser');
    Route::patch('user/{user}', 'UserController@update')->name('update-user');
    Route::get('user/{user}', 'UserController@show')->name('find-user');
    Route::get('users', 'UserController@list')->name('list-users');

    Route::post('booking', 'BookingController@create')->name('create-booking');
    Route::post('booking/{booking}', 'BookingController@find')->name('find-booking');
    Route::patch('booking/{booking}', 'BookingController@update')->name('update-booking');
    Route::post('get-bookings', 'BookingController@list')->name('list-bookings');
});
