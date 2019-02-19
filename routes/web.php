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
    return view('login');
});
//
////用与web浏览器
///
Route::get('test', 'Auth\LoginController@test');

Route::get('/', 'WebController@index');
//Route::controllers([
//    'Web' => 'WebController',
//]);
//
////用于web 认证控制
//
//Route::controllers([
//    'webauth' => 'Auth\WebAuthController',
//    'webpassword' => 'Auth\WebPasswordController',
//]);
