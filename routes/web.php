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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('users', 'UsersController');
    Route::resource('pages', 'PagesController');
    Route::resource('activitylogs', 'ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('settings', 'SettingsController');
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

    Route::resource('room', 'RoomController');
    Route::resource('room_types', 'RoomTypesController');
    Route::resource('room_types', 'RoomTypesController');
    Route::resource('room', 'RoomController');
    Route::resource('reservations', 'ReservationsController');
    Route::resource('transactions', 'TransactionsController');
});

Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'middleware' => ['auth', 'roles'], 'roles' => 'customer'], function () {
    Route::get('/', 'CustomerController@index');
    Route::get('booking', 'BookingController@index');
});

Route::get('/room/search', 'GuestController@search');
Route::post('/reservation/preview', 'GuestController@addToCart');
Route::post('/remove-reservation', 'GuestController@removeToCart');
Route::get('/reservation/clear', 'GuestController@clearCart');
Route::get('/reservation/checkout', 'GuestController@preview');
Route::post('reservation', 'GuestController@reserve');

Route::get('/test', function (){
    return new \App\Mail\ReservationCreated($reservation);
});

