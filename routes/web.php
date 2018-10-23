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
       route::resource('/voucher','VoucherController');
       route::resource('/user_management','UserManagementController');
       route::post('user_management/CheckLevel','UserManagementController@check_level');
       route::resource('/game', 'GameController');
       Route::post('game/getLevel','GameController@get_level');
       Route::post('game/checkLevelExit','GameController@check_level_exit');
});
