<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //定义基本的属性
    protected $table = 'lesson';

    // 关联Course模型（一对一）
    public function rel_course(){
    	//返回关联关系
    	return $this -> hasOne('App\Model\Course','id','course_id');
    }
}
