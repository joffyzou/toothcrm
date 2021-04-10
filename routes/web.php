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
    return view('admins.login2');
});

// 登录、退出
Route::get('admin/login', 'LoginController@index')->name('admin.login');
Route::post('admin/login', 'LoginController@login')->name('admin.login');
Route::post('admin/logout', 'LoginController@logout')->name('admin.logout');

Route::resource('admins', 'AdminsController');

// admins.create 新建员工 排除[3, 5]
// admins.index role_id=1 pid=

