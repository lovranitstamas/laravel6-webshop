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

Route::get('/shop', 'ShopController@index')->name('visitors.shop');
Route::get('/shop/show/{product}/{page}', 'ShopController@show')->name('visitors.shop.show');

Route::get('/registration', 'CustomersController@create')->name('customer.create');
Route::post('/registration', 'CustomersController@store')->name('customer.store');

Route::middleware('customer_auth')->group(function () {
    Route::get('/customers', 'CustomersAuthController@index')->name('customers.index');
    Route::get('/customer/edit', 'CustomersAuthController@edit')->name('customer.edit');
    Route::put('/customer/update', 'CustomersAuthController@update')->name('customer.update');
    Route::delete('/logout', 'CustomersAuthController@destroy')->name('login.destroy');

    Route::get('/shop/order/{product}', 'ShopController@order')->name('visitors.shop.order');
    Route::post('/shop/order', 'ShopController@store')->name('visitors.shop.order.store');
});

Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::namespace('Auth')->group(function () {

        Route::get('/login', 'LoginController@showLoginForm')->name('login.create');
        Route::post('/login', 'LoginController@login')->name('login.store');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });

    Route::middleware('admin_auth')->group(function () {
        Route::get('/index', 'DashboardController@index')->name('dashboard');

        Route::resource('customer', 'CustomerController');
        Route::resource('category', 'CategoryController');
        Route::resource('sub_category', 'SubCategoryController');
        Route::resource('transport', 'TransportController');
        Route::resource('product', 'ProductController');
        Route::resource('order', 'OrderController');

        Route::get('/avatar/download/{path}/{name}', 'ProductController@avatarDownload')->name('avatar.download');
    });
});

//Auth::routes();

/*
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
*/
