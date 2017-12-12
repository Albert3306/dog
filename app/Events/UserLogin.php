<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Users;
use App\Models\SystemLogs;
use Illuminate\Queue\SerializesModels;

class UserLogin extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        // 记录登录日志
        $log = [
            'user_id' => $user->id,
            'url'     => env('ADMIN_SITE') . site_path('auth/login', 'admin'),
            'type'    => 'session',
            'content' => '管理员：'.$user->nickname.'['.$user->username.'] 登录系统。',
        ];

        $log_db = New SystemLogs;
        $log_db->write($log);

        // 更新登录数据
        $data = [
            'login'         => $user->login + 1,
            'last_login_ip' => app('request')->ip(),
        ];
        $user_db = New Users;
        $user_db->fill($data);
        $user_db->where('id','=',$user->id)->update($data);
    }
}
