<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 用户登录、退出
|--------------------------------------------------------------------------
*/
Route::get('login', 'LoginController@index')->name('admin.login');    // 登录
Route::post('login', 'LoginController@login')->name('admin.store');  // 保存登录状态
Route::delete('logout', 'LoginController@logout')->name('admin.logout')->middleware('auth');    // 退出

/*
|--------------------------------------------------------------------------
| 后台公共页面
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'], function () {
    Route::get('/console/kf', 'IndexController@index')->name('admin.index');   // 后台首页

    Route::get('/console','IndexController@console')->name('admin.console');    // 后台控制台

    Route::any('/sums', 'IndexController@sums')->name('sums');

    Route::get('operate', 'IndexController@operate')->name('operate');

    Route::get('customer', 'IndexController@customer')->name('customer');
});

/*
|--------------------------------------------------------------------------
| 系统管理模块
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System', 'middleware' => ['auth', 'permission:system']], function () {
    Route::resource('permissions', 'PermissionsController');    // 权限管理

    Route::resource('roles', 'RolesController');    // 角色管理

    Route::resource('users', 'UsersController');  // 用户管理
    Route::post('users/status', 'UsersController@status')->name('users.status');

    Route::resource('platforms', 'PlatformsController'); // 平台管理
});

/*
|--------------------------------------------------------------------------
| CRM模块
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'crm', 'as' => 'crm.', 'namespace' => 'Crm', 'middleware' => ['auth', 'permission:crm']], function () {
    Route::resource('departments', 'DepartmentsController');    // 部门管理

    Route::resource('patients', 'PatientsController');  // 患者管理

//    Route::match(['get', 'post'],'users/{user}/patients', 'UsersController@patients')->name('users.patients'); // 我的患者
//    Route::match(['get', 'put'], 'users', 'UsersController@index')->name('users.index');   // 修改账号密码
    Route::post('patients/updates', 'PatientsController@updates')->name('patients.updates');

    Route::resource('repays', 'RepaysController');  // 回访管理

    Route::resource('seas', 'SeasController');  // 公海
});

//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'permission:admin']], function () {
//
//
//});


