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
Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\LoginController@login');


Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/user', function (Request $request) {
	    return $request->user();
	});

	Route::put('/user/update', 'API\UserController@update');

	Route::get('/streaming', 'API\StreamingController@index');
	Route::post('/streaming/store','API\StreamingController@store');
	Route::put('/streaming/{id}/update','API\StreamingController@update');
	Route::delete('/streaming/{id}/delete', 'API\StreamingController@destroy');

	Route::get('/present','API\PresentController@index');
	Route::get('/present/qr-code/{code}','API\PresentController@show');
	Route::post('/present/store','API\PresentController@store');
	Route::put('/present/{id}/update','API\PresentController@update');
	Route::delete('/present/{id}/delete','API\PresentController@destroy');

	Route::get('/user-presence','API\UserPresentController@index');
	Route::post('/user-presence/{code}/store','API\UserPresentController@store')->name('user-presence.store');
});

