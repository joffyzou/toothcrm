<?php

use Illuminate\Support\Facades\Route;

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
    return view('admins.login');
});

// 登录、退出
Route::get('admin/login', 'LoginController@index')->name('admin.login');
Route::post('admin/login', 'LoginController@login');
Route::post('admin/logout', 'LoginController@logout')->name('admin.logout');

Route::resource('admins', 'AdminsController');

Route::resource('patients', 'PatientsController');

// admins.create 新建员工 排除[3, 5]
// admins.index role_id=1 pid=

// Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
//     // 角色列表
//     Route::group(['prefix' => 'role','as' => 'role.'], function () {
//         Route::get('/{id}', 'RoleController@show')->where('id', '\d+')->name('show');
//         Route::put('/{id}', 'RoleController@update')->where('id', '\d+')->name('update');
//         Route::post('/', 'RoleController@store')->name('store');
//         Route::delete('/{id}', 'RoleController@destroy')->where('id', '\d+')->name('destroy');
//         // 获取某一角色的权限列表
//         Route::get('/node/{id}', 'RoleController@nodeList')->name('node');
//         // 更新某一角色的权限列表
//         Route::post('/node/{role}', 'RoleController@saveNode')->name('node');
//     });

//     // 节点列表
//     Route::group(['prefix' => 'node','as' => 'node.'], function () {
//         Route::get('/{id}', 'NodeController@show')->where('id', '\d+')->name('show');
//         Route::put('/{id}', 'NodeController@update')->where('id', '\d+')->name('update');
//         Route::post('/', 'NodeController@store')->name('store');
//         Route::delete('/{id}', 'NodeController@destroy')->where('id', '\d+')->name('destroy');
//     });

//     // 用户列表
//     Route::group(['prefix' => 'user','as' => 'user.'], function () {
//         Route::get('/{id}', 'UserController@show')->where('id', '\d+')->name('show');
//         Route::put('/{id}', 'UserController@update')->where('id', '\d+')->name('update');
//         Route::post('/', 'UserController@store')->name('store');
//         Route::delete('/{id}', 'UserController@destroy')->where('id', '\d+')->name('destroy');
//     });
// });
