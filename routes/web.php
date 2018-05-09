<?php

/*----- 管理后台路由群组 -----*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', function() {
        return redirect('/admin/login');
    });

    # 退出
    Route::get('logout', 'LoginController@getLogout');
    # 登录
    Route::get('login', 'LoginController@getLogin');
    Route::post('login', 'LoginController@postLogin');

    Route::group(['prefix' => '', 'middleware' => ['auth:admin']], function () {
        Route::get('index', 'IndexController@index');

        // 开发演示
        Route::get('demo/{type?}', function ($type = 'typography') {
            return view('admin.demo.'.$type);
        });

        // 用户管理
        Route::get('user', 'UsersController@getInfo');
        Route::put('user', 'UsersController@putInfo');
        Route::resource('users', 'UsersController');

        // 系统管理
        Route::get('seting', 'ConfigController@getConfig');
        Route::put('seting', 'ConfigController@putConfig');
        Route::resource('log', 'LogController');
    });
});

/*----- 管理前台路由群组 -----*/
Route::group(['prefix' => '', 'namespace' => 'Desktop'], function () {
    //桌面站主页
    Route::get('/', 'IndexController@index');
});
