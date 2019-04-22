<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Role;
// 引入Input
use Input;
// 引入Auth模型
use App\Model\Auth;

class RoleController extends Controller
{
    // 列表
    public function index(){
    	// 查询数据
    	$data = Role::all();
    	// 输出数据并且展示视图
    	return view('admin.role.index',compact('data'));
    }

    // 角色权限分派
    public function assign(){
    	// 判断请求类型
    	if(Input::method() == 'POST'){
    		// post
    		// 1. 获取基本的数据
    		$ids = Input::get('auth_ids');
    		$role_id = Input::get('id');
    		// 2. 递交给模型处理
    		$model = new \App\Model\Role;
    		// 调用模型中自定义的方法去处理数据并且保存到数据表中
    		if($model -> assignAuth($role_id,$ids)){
    			// 成功
    			$response = ['code' => 0,'msg' => '权限分派成功！'];
    		}else{
    			// 失败
    			$response = ['code' => 1,'msg' => '权限分派失败！'];
    		}
    		// 响应
    		return response() -> json($response);
    	}else{
    		// get
    		// // 查询权限的权限的情况
    		$parent = Auth::where('pid','0') -> get();//父级
    		$children = Auth::where('pid','!=','0') -> get();//子级
    		// 查询当前正在分配权限的角色名称
    		$role = Role::find(Input::get('id'));
    		return view('admin.role.assign',compact('parent','children','role'));
    	}
    }
}
