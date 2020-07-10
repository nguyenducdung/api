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
use Illuminate\Support\Facades\Route;
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'namespace' => 'Api',
], function () {
    //Chưa Login
    Route::post('login',            'LoginController@login');
//    Route::post('auto-login',       'LoginController@autoLogin');
    //Đã Login
    Route::group([
        'middleware' => 'app.auth'
    ],function (){
        // Customer
        Route::group([
            'prefix' => 'customer',
        ],function (){
            Route::get('info',    'CustomerController@getInfo');
            Route::post('update', 'CustomerController@update');
        });
        // Bill
        Route::group([
            'prefix' => 'bill',
        ],function (){
            Route::get('get-by-customer',               'BillController@getByCustomer');
            Route::get('info/{id}',                     'BillController@getInfo');
            Route::post('store',                        'BillController@store');
            Route::post('update-bill-food',             'BillController@updateBillFood');
        });
        // Food
        Route::group([
            'prefix' => 'food',
        ],function (){
            Route::get('endow',                 'FoodController@endow');
            Route::get('history',               'FoodController@history');
            Route::get('suggestion',            'FoodController@suggestion');
            Route::get('get-by-type/{id}',      'FoodController@getByType');
            Route::get('info/{id}',             'FoodController@getInfo');
            Route::post('search',               'FoodController@search');
            Route::post('vote',                 'FoodController@vote');

        });
        // Type
        Route::group([
            'prefix' => 'type',
        ],function (){
            Route::get('get-all',           'TypeController@getAll');
        });
        // Voucher
        Route::group([
            'prefix' => 'voucher',
        ],function (){
            Route::get('get-all',            'VoucherController@getAll');
            Route::get('get-by-customer',    'VoucherController@getByCustomer');

        });
        // Customer
        Route::group([
            'prefix' => 'table',
        ],function (){
            Route::get('get-all',       'TableController@getAll');
            Route::get('info/{id}',     'TableController@getInfo');
            Route::post('update',       'TableController@update');
        });
        // Type
        Route::group([
            'prefix' => 'app-id',
        ],function (){
            Route::get('get-all',               'AppIdController@getAll');
            Route::post('save-token',           'AppIdController@saveToken');

        });
    });
});
