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

//微信路由，无需登录
Route::group(['prefix' => 'weixin', 'namespace' => 'Weixin', 'middleware' => ['api']], function () {

    //页面跳转
    Route::any('/index', 'IndexController@index');

});
