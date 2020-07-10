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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::group([
    'namespace' => 'Backend',
    'middleware' => 'auth',
    'prefix'=>'admin'
],function (){
    Route::get('/',                      'HomeController@index')->name('dashboard');
    Route::resource('user',         'UserController');
    Route::resource('food',         'FoodController');
    Route::resource('bill',         'BillController');
    Route::resource('role',         'RoleController');
    Route::resource('table',        'TableController');
    Route::resource('report',       'ReportController');
    Route::resource('voucher',      'VoucherController');
    Route::resource('category',     'CategoryController');
    Route::resource('customer',     'CustomerController');
    Route::resource('notification', 'NotificationController');

    Route::group([
        'prefix'=>'user',
    ],function (){
        Route::get('delete/{id}',       'UserController@destroy')->name('user.destroy');
        Route::post('update/{id}',      'UserController@update')->name('user.update');
    });

    Route::group([
        'prefix'=>'category',
    ],function (){
        Route::get('delete/{id}',       'CategoryController@destroy')->name('category.destroy');
        Route::post('update/{id}',      'CategoryController@update')->name('category.update');
    });
    Route::group([
        'prefix'=>'table',
    ],function (){
        Route::get('delete/{id}',       'TableController@destroy')->name('table.destroy');
        Route::post('update/{id}',      'TableController@update')->name('table.update');
    });
    Route::group([
        'prefix'=>'voucher',
    ],function (){
        Route::get('delete/{id}',       'VoucherController@destroy')->name('voucher.destroy');
        Route::post('update/{id}',      'VoucherController@update')->name('voucher.update');
    });
    Route::group([
        'prefix'=>'food',
    ],function (){
        Route::get('delete/{id}',       'FoodController@destroy')->name('food.destroy');
        Route::post('update/{id}',      'FoodController@update')->name('food.update');
    });
    Route::group([
        'prefix'=>'customer',
    ],function (){
        Route::get('delete/{id}',       'CustomerController@destroy')->name('customer.destroy');
        Route::post('update/{id}',      'CustomerController@update')->name('customer.update');
    });
    Route::group([
        'prefix'=>'user-token',
    ],function (){
        Route::get('delete/{id}',       'UserTokenController@delete')->name('user_token.delete');
        Route::post('/',                'UserTokenController@index')->name('user_token.index');
    });
    Route::group([
        'prefix'=>'bill',
    ],function (){
        Route::get('/',                 'BillController@index')->name('bill.index');
        Route::get('delete/{id}',       'BillController@delete')->name('bill.delete');
        Route::get('paid/{id}',       'BillController@paid')->name('bill.paid');

    });
    Route::group([
        'prefix'=>'staff',
    ],function (){
        Route::get('/',                             'StaffController@getWaitingFood')->name('staff.index');
        Route::post('update-status',                'StaffController@updateStatus')->name('staff.updateStatus');

    });
});
//https://docs.google.com/spreadsheets/d/1lWTNNj6788XeuL70htWXuma4sMphdmI-v6gPzawXqnw/edit?fbclid=IwAR22poqnl6XtMHNvYcB8I4dyjGDP2HzU-kmQICw8A8eNu5C53nWszHvIJ3s