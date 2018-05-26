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
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
	return view('statistics.index');
})->name('home');

Route::group(['middleware' => 'auth'], function() {
    //
	Route::get('/room/all', 'RoomController@all');
	Route::get('/rooms/available', 'RoomController@availables');
	Route::get('/room/search', 'RoomController@search');
	Route::post('/room/uploadPhoto', 'RoomController@uploadPhoto');
	Route::get('/room/{room}/photos', 'RoomController@getPhotos');
	Route::resource('room', 'RoomController');

	Route::get('/roomTypes/all', 'RoomTypeController@all');

	Route::get('/user/all', 'UserController@all');
	Route::get('/user/search', 'UserController@search');
	Route::resource('user', 'UserController');

	Route::get('/reservation/all', 'ReservationController@all');
	Route::get('/reservation/checkSatus', 'ReservationController@checkSatus');
	Route::post('/reservation/evacuate', 'ReservationController@evacuate');
	Route::get("/reservation/getReserveBySate", "ReservationController@getReserveBySate");
	Route::resource('reservation', 'ReservationController');

	
	Route::get('/statistics', 'StatisticsController@index');
});
