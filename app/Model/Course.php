<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //定义基本的属性
    protected $table = 'course';

    // 定义关联关系，关联profession模型
    public function rel_profession(){
    	//返回关联关系
    	return $this -> hasOne('App\Model\Profession','id','profession_id');
    }
}
