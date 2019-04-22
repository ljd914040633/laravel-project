<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //定义关联的数据表名称
    protected $table = 'auth';
    //定义时间是否允许自动更新
    public $timestamps = false;
    //定义允许修改的字段
    protected $fillable = ['id','auth_name','controller','action','pid','is_nav'];
    //禁止修改的字段
    //protected $guard = [];
}
