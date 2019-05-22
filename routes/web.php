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
//后台
Route::group([],function(){
    //后台首页
	Route::get('admin','Admin\IndexController@index');
	//后台管理员
	Route::resource('/admin/user','Admin\UserController');
	
});

//前台首页
Route::get('/', 'Home\IndexController@index');

//前台
 
Route::group([],function(){
   
});


Route::get('admin/insert');
