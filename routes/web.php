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
    return redirect()->route('login');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/dashboard', function(){
	return redirect()->route('home');
});

Route::get('logout', 'Auth\LoginController@logout', function () {
    return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/dashboard/home/save', 'BusStopController@store');

Route::get('/account', function(){
	return redirect()->route('profile');
});

Route::get('/account/profile', 'UserDetailsController@index')->name('profile');

Route::get('/account/profile/get-majors/{faculty}', 'FacultyController@getMajors');

Route::get('/account/profile/get-meeting-points/{id}', 'MeetingPointController@getMeetingPoints');

Route::post('/account/profile/submit', 'UserDetailsController@store')->name('updateProfile');

Route::post('/account/profile/upload', 'UserController@update')->name('updateAvatar');

Route::post('/account/settings/submit', 'UserController@edit')->name('updateSettings');

Route::get('/account/settings', 'UserController@index')->name('settings');

Route::delete('/dashboard/home/delete/{id}', 'BusStopController@destroy')->name('deleteStop');

Route::get('/dashboard/stops', 'BusStopController@index')->name('stops');

Route::get('/dashboard/leaving', 'BusStopController@secondaryIndex')->name('leaving');

Route::get('/dashboard/tracking', 'GeolocationController@index')->name('tracker');

Route::get('/dashboard/location', 'GeolocationController@user_view')->name('location');

Route::post('/dashboard/tracking/location/update', 'GeolocationController@update');

Route::post('/dashboard/tracking/location/get', 'GeolocationController@show');
