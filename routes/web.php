<?php

/*----- 后台路由群组 START -----*/
$_ap = config('site.route.prefix.admin', 'admin');
Route::group(['prefix' => $_ap, 'namespace' => 'Admin'], function () {
    Route::get('/', function() {
        return redirect(config('site.route.prefix.admin', 'admin').'/auth/login');
    });

    Route::group(['prefix' => 'auth'], function () {
        $Auth = 'AuthController@';
        # 退出
        Route::get('logout', $Auth.'getLogout');
        # 登录
        Route::get('login', $Auth.'getLogin');
        Route::post('login', $Auth.'postLogin');
    });

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
/*----- 后台路由群组 END -----*/

/*----- 前台路由群组 START -----*/
$_dp = config('site.route.prefix.desktop', '');
Route::group(['prefix' => $_dp, 'namespace' => 'Desktop'], function () {
    //桌面站主页
    Route::get('/', 'IndexController@index');
});
/*----- 前台路由群组 END -----*/
