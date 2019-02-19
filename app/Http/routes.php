<?php
/**
 * Created by PhpStorm.
 * User: lfq
 * Date: 2019/2/15
 * Time: 10:20 AM
 */

//用与web浏览器
Route::get('/', 'WebController@index');
Route::controllers([
    'Web' => 'WebController',
]);

//用于web 认证控制

Route::controllers([
    'webauth' => 'Auth\WebAuthController',
    'webpassword' => 'Auth\WebPasswordController',
]);
