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
    Route::delete('logout', 'LoginController@logout')->name('logout');    // 退出


    Route::resource('admins', 'AdminsController');  // 管理员管理

    Route::resource('patients', 'PatientsController');  // 患者管理
    Route::match(['get', 'post'],'admins/{admin}/patients', 'AdminsController@patient')->name('admins.patients'); // 我的患者
    Route::match(['get', 'put'], 'patients','PatientsController@index')->name('patients.index'); // 患者公海

    Route::resource('repays', 'RepaysController');  // 回访管理

    Route::resource('platforms', 'PlatformsController')->only(['store']); // 平台管理

    Route::get('/', 'IndexsController@index')->name('index');   // Dashboard 面板
});
