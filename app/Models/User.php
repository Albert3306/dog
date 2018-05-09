<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'id', 'username', 'email', 'mobile', 'nickname', 'login', 'reg_ip', 'last_login_at', 'last_login_ip', 'type', 'status', 'created_at', 'updated_at',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
