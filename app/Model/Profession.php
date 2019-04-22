<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //定义表名
    protected $table = 'profession';

    // 关联专业分类
    public function rel_protype(){
    	// 一对一的关系
    	return $this -> hasOne('App\Model\Protype','id','protype_id');
    }
}
