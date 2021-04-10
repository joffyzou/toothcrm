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
    return view('admins.dashboard');
});

// 登录、退出
Route::get('admin/login', 'LoginController@index')->name('admin.login');
Route::post('admin/login', 'LoginController@login')->name('admin.login');
Route::delete('admin/logout', 'LoginController@logout')->name('admin.logout');

Route::resource('admins', 'AdminsController');
Route::get('admin/dashboard', 'AdminsController@dashboard')->name('admin.dashboard');

