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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', 'LoginController@index')->name('login');    // 登录
    Route::post('login', 'LoginController@login')->name('store');  // 保存登录状态
    Route::post('logout', 'LoginController@logout')->name('logout');    // 退出

    Route::resource('admins', 'AdminsController');  // 管理员管理

    Route::resource('patients', 'PatientsController');  // 患者管理
    Route::match(['get', 'post'],'admins/{admin}/patients', 'AdminsController@patient')->name('admins.patients'); // 我的患者
    Route::any('patients','PatientsController@index')->name('patients.index'); // 患者公海

    Route::resource('repays', 'RepaysController');  // 回访管理

    Route::resource('platforms', 'PlatformsController')->only(['store']); // 平台管理
});

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
