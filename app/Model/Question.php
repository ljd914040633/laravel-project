<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //定义模型需要关联的数据表
    protected $table = 'question';

    // 定义模型的关联关系
    public function rel_paper(){
    	// 关系：一对一
    	return $this -> hasOne('App\Model\Paper','id','paper_id');
    }
}
