<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    //定义关联的数据表
    protected $table = 'live';

    //需要关联对应的模型
    public function rel_profession(){
    	//返回关联的关系
    	return $this -> hasOne('App\Model\Profession','id','profession_id');
    }

    public function rel_stream(){
    	//返回关联关系
    	return $this -> hasOne('App\Model\Stream','id','stream_id');
    }
}
