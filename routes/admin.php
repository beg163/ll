<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Auth::routes();

Route::group(['middleware' => 'auth.admin'], function(){
	//首页
	Route::get('index', 'DashboardController@index');

	Route::group(['namespace' => 'AdminUser', 'prefix' => 'adminuser'], function(){
		//权限管理路由
		Route::resource('permission', 'PermissionController');

		//角色管理路由
		Route::resource('role', 'RoleController');

		//用户管理路由
		Route::resource('user', 'UserController');
	});

});
