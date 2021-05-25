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
    Route::get('/', 'IndexsController@index')->name('index');   // Dashboard 面板

    Route::get('login', 'LoginController@index')->name('login');    // 登录
    Route::post('login', 'LoginController@login')->name('store');  // 保存登录状态
    Route::delete('logout', 'LoginController@logout')->name('logout');    // 退出

    Route::get('users/{user}/patients', 'UsersController@patients')->name('users.patients'); // 我的患者
    Route::resource('users', 'UsersController');  // 管理员管理
    Route::match(['get', 'put'], 'users', 'UsersController@index')->name('users.index');   // 修改账号密码

    Route::resource('patients', 'PatientsController');  // 患者管理

//    Route::get('users/{user}/patients', 'UsersController@showPatientsView')->name('users.patients'); // 我的患者
//    Route::match(['get', 'post'],'users/{user}/patients/data', 'UsersController@usersPatientsData')->name('users.patients.data'); // 我的患者
    Route::post('patients/updates', 'PatientsController@updates')->name('patients.updates');

    Route::resource('repays', 'RepaysController');  // 回访管理

    Route::resource('platforms', 'PlatformsController')->only(['store']); // 平台管理
});
