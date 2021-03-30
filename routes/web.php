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
/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', 'DefaultController@index')->name('index');

Route::get('/login', 'CustomersAuthController@create')->name('login.create');
Route::post('/login', 'CustomersAuthController@store')->name('login.store');

Route::get('/registration', 'CustomersController@create')->name('customer.create');
Route::post('/registration', 'CustomersController@store')->name('customer.store');

Route::middleware('customer_auth')->group(function () {
    Route::get('/customers', 'CustomersAuthController@index')->name('customers.index');
    Route::delete('/logout', 'CustomersAuthController@destroy')->name('login.destroy');
});
