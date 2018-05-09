<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\SystemLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * 用户登录/登出等活动事件监听器
 */
class UserEventListener
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        $user = $event->user;

        // 记录登录日志
        $log = [
            'user_id' => $user->id,
            'url'     => url('/admin/login'),
            'type'    => 'session',
            'content' => '管理员：'.$user->nickname.'['.$user->username.'] 登录系统。'
        ];

        $log_db = New SystemLog;
        $log_db->write($log);

        // 更新登录数据
        $data = [
            'login'         => $user->login + 1,
            'last_login_ip' => app('request')->ip(),
            'last_login_at' => date('Y-m-d H:i:s'),
        ];

        $user_db = New User;
        $user_db->fill($data);
        $user_db->where('id', '=', $user->id)->update($data);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        $user = $event->user;

        // 记录登出日志
        $log = [
            'user_id' => $user->id,
            'url'     => url('/admin/logout'),
            'type'    => 'session',
            'content' => '管理员：'.$user->nickname.'['.$user->username.'] 登出系统。',
        ];

        $log_db = New SystemLog;
        $log_db->write($log);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('App\Events\UserLogin', 'App\Listeners\UserEventListener@onUserLogin');
        $events->listen('App\Events\UserLogout', 'App\Listeners\UserEventListener@onUserLogout');
    }
}
