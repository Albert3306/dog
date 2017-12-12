<?php

namespace App\Events;

use App\Events\Event;
use App\Models\SystemLogs;
use Illuminate\Queue\SerializesModels;

class UserLogout extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        // 记录登出日志
        $log = [
            'user_id' => $user->id,
            'url'     => env('ADMIN_SITE') . site_path('auth/logout', 'admin'),
            'type'    => 'session',
            'content' => '管理员：'.$user->nickname.'['.$user->username.'] 登出系统。',
        ];

        $log_db = New SystemLogs;
        $log_db->write($log);
    }
}
