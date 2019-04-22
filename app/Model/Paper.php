<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //定义关联的数据表
    protected $table = 'paper';

    // 关联Course模型
    public function rel_course(){
    	// 关系：一对一
    	return $this -> hasOne('App\Model\Course','id','course_id');
    }
}
