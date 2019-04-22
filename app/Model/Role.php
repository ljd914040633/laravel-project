<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //定义基本的内容
    protected $table = 'role';
    //禁止事件更新
    public $timestamps = false;

    // 自定义方法去实现权限分派的保存
    public function assignAuth($role_id,$auth_ids){
    	// 生成auth_ids字段的数据
    	$data['auth_ids'] = implode($auth_ids,',');
    	// 先去查询权限的信息
    	$auths = Auth::where('pid','!=','0') -> whereIn('id',$auth_ids) -> get();
    	// 拼凑控制器和方法名称
    	$ac = '';
    	// 循环拼凑
    	foreach ($auths as $key => $value) {
    		$ac .= $value -> controller . '@' . $value ->  action . ',';
    	}
    	$data['auth_ac'] = rtrim($ac,',');
    	// 写入数据表
    	return $this -> where('id',$role_id) -> update($data);
    }
}
