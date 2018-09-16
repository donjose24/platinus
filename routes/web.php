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

Route::get('/contact', function () {
    return view('webpage.contact');
});

Route::get('/location', function () {
    return view('webpage.location');
});

Route::get('/roomrates', function () {
    return view('webpage.roomrates');
});

Route::get('/facilities', function () {
    return view('webpage.facilities');
});

//tests reports only
Route::get('/reports/reservations', function () {
    $reservation = \App\Reservation::find(1);
    $diff = 2;
    return view('reports.reservation', compact('reservation', 'diff'));
});
Route::get('/reports/users', function () {
    return view('reports.users');
});
Route::get('/reports/transaction', function () {
    return view('reports.transaction');
});
Route::get('/cashier/checkin', function () {
    return view('cashier.checkin');
});
Route::get('/cashier/checkout', function () {
    return view('cashier.checkout');
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
    Route::get('reservation/print/{id}', 'ReservationsController@printReservation');

    Route::resource('room', 'RoomController');
    Route::resource('room_types', 'RoomTypesController');
    Route::resource('room_types', 'RoomTypesController');
    Route::resource('room', 'RoomController');
    Route::resource('reservations', 'ReservationsController');
    Route::resource('transactions', 'TransactionsController');
    Route::get('sales/print', 'TransactionsController@printTransactions');
});

Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'middleware' => ['auth', 'roles'], 'roles' => 'customer'], function () {
    Route::get('/', 'CustomerController@index');
    Route::get('reservation', 'CustomerController@showReservationForm');
    Route::get('booking', 'BookingController@index');
    Route::put('reservation', 'CustomerController@uploadDepositSlip');
});

Route::group(['namespace' => 'Cashier', 'prefix' => 'cashier', 'middleware' => ['auth', 'roles'], 'roles' => 'cashier'], function () {
    Route::get('/', 'CashierController@index');
    Route::get('deposit', 'CashierController@deposits');
    Route::post('deposit/approve', 'CashierController@approve');
    Route::post('deposit/reject', 'CashierController@reject');
    Route::get('deposit/{id}', 'CashierController@view');
    Route::get('reservation/{id}', 'CashierController@show');
    Route::post('checkin', 'CashierController@checkIn');
    Route::get('reservation', 'CashierController@reservation');
    Route::get('reservation/print/{id}', 'CashierController@printReservation');
    Route::get('reservation/checkout/{id}', 'CashierController@checkOut');
    Route::get('rooms/available', 'CashierController@getAvailableRooms');
    Route::post('reservation/room/edit', 'CashierController@updateRoom');
    Route::post('reservation/room/delete', 'CashierController@deleteRoom');
    Route::post('reservation/room', 'CashierController@addRoom');
});

Route::get('dashboard', 'Auth\LoginController@redirect');
Route::get('/room/search', 'GuestController@search');
Route::post('/reservation/preview', 'GuestController@addToCart');
Route::post('/remove-reservation', 'GuestController@removeToCart');
Route::get('/reservation/clear', 'GuestController@clearCart');
Route::get('/reservation/checkout', 'GuestController@preview');
Route::post('reservation', 'GuestController@reserve');
Route::get('/edit', 'CashierController@getAvailableRooms');
