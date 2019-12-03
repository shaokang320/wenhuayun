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

//后台路由
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web']], function () {
    Route::get('/', 'IndexController@index')->name('admin');
    Route::get('/welcome', 'IndexController@welcome')->name('admin_welcome');

    //企业管理
    Route::get('/enterprise', 'EnterpriseController@index')->name('admin_enterprise');
    Route::get('/enterprise/add', 'EnterpriseController@add')->name('admin_enterprise_add');
    Route::post('/enterprise/doadd', 'EnterpriseController@doadd')->name('admin_enterprise_doadd');
    Route::get('/enterprise/edit', 'EnterpriseController@edit')->name('admin_enterprise_edit');
    Route::post('/enterprise/doedit', 'EnterpriseController@doedit')->name('admin_enterprise_doedit');
    Route::post('/enterprise/editStatus', 'EnterpriseController@editStatus')->name('admin_enterprise_editStatus');
    Route::get('/enterprise/del', 'EnterpriseController@del')->name('admin_enterprise_del');

    //后台登录
    Route::get('/login', 'LoginController@login')->name('admin_login');
    Route::post('/dologin', 'LoginController@dologin')->name('admin_dologin');
    Route::get('/logout', 'LoginController@logout')->name('admin_logout');
    Route::get('/recoverpwd', 'LoginController@recoverpwd')->name('admin_recoverpwd');
    //页面跳转
    Route::get('/jump', 'LoginController@jump')->name('admin_jump');

});

// 企业后台
Route::group(['prefix' => 'enterprise', 'namespace' => 'Enterprise', 'middleware' => ['web']], function () {
    Route::any('/', 'IndexController@index')->name('enterprise');
    Route::get('/welcome', 'IndexController@welcome')->name('enterprise_welcome');
    Route::any('/editPwd', 'IndexController@editPwd')->name('enterprise_editPwd');

    //企业文化
    Route::any('/culture', 'CultureController@index')->name('enterprise_culture');
    Route::get('/culture/add', 'CultureController@add')->name('enterprise_culture_add');
    Route::post('/culture/doadd', 'CultureController@doadd')->name('enterprise_culture_doadd');
    Route::get('/culture/edit', 'CultureController@edit')->name('enterprise_culture_edit');
    Route::post('/culture/doedit', 'CultureController@doedit')->name('enterprise_culture_doedit');
    Route::get('/culture/del', 'CultureController@del')->name('enterprise_culture_del');
    Route::post('/culture/editStatus', 'CultureController@editStatus')->name('enterprise_culture_editStatus');

    //登录注销
    Route::get('/login', 'LoginController@login')->name('enterprise_login');
    Route::post('/dologin', 'LoginController@dologin')->name('enterprise_dologin');
    Route::get('/logout', 'LoginController@logout')->name('enterprise_logout');
    Route::get('/recoverpwd', 'LoginController@recoverpwd')->name('enterprise_recoverpwd');
    //页面跳转
    Route::get('/jump', 'LoginController@jump')->name('admin_jump');

});

//前台路由
Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('/page404', 'IndexController@page404')->name('page404');         //404页面

});
