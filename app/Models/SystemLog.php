<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = ['user_id', 'type', 'url', 'content', 'operator_ip'];

    /**
    * 操作用户
    * 模型对象关系：系统日志对应的操作用户
    *
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    /**
     * 记录系统日志
     * @param  array  $data 需要写入的数据
     */
    public function write($data)
    {
        $data['operator_ip'] = app('request')->ip();
        $this->fill($data);
        return $this->save($data);
    }
}
