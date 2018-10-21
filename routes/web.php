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

Route::group(['middleware' => 'auth'], function () {
       /*Route::get('/voucher', 'VoucherController@index');
       Route::get('/voucher/add', 'VoucherController@create');
       Route::post('voucher/store', 'VoucherController@store');
       Route::get('voucher/edit/{id}', 'VoucherController@edit');
       Route::post('voucher/update', 'VoucherController@update');*/

       route::resource('/voucher','VoucherController');
       route::resource('/user_management','UserManagementController');

       //Route::get('/user', 'UserController@index');
       Route::get('/game', 'GameController@index');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
