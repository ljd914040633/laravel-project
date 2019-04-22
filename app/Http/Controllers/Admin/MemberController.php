<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Member;
// 引入input
use Input;
use DB;

class MemberController extends Controller
{
    //会员列表
    public function index(){
    	//获取数据
    	$data = Member::all();
    	//展示视图，携带数据
    	return view('admin.member.index',compact('data'));
    }

    // 用户添加
    public function add(){
    	// 请求类型的判断
    	if(Input::method() == 'POST'){
    		//post
    		// 自动的数据验证
    		// 入表
    		$data = Input::all();
    		unset($data['_token']);
    		// 对密码进行加密
    		$data['password'] = bcrypt($data['password']);
    		// $data['avatar'] = '/statics/avatar.jpg';// 临时
            // 去掉webuploader默认追加的file表单项
            unset($data['file']);
    		$data['created_at'] = date('Y-m-d H:i:s');
    		if(Member::insert($data)){
    			// 成功
    			$response = ['code' => 0,'msg' => '会员创建成功！'];
    		}else{
    			// 失败
    			$response = ['code' => 1,'msg' => '会员创建失败！'];
    		}
    		// 返回
    		return response() -> json($response);
    	}else{
    		//get
    		// 获取国家部分的数据
    		$country = DB::table('area') -> where('pid','0') -> get();
    		return view('admin.member.add',compact('country'));
    	}
    }

    // 根据地区id获取其下属的行政区划
    public function getAreaById(){
    	// 获取id
    	$id = (int) Input::get('id');
    	// 获取下属地址
    	$data = DB::table('area') -> where('pid',$id) -> get();
    	// 输出json数据
    	return response() -> json($data);
    }
}
