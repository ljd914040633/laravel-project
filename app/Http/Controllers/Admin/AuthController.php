<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Input
use Input;
// 引入模型
use App\Model\Auth;
// 引入DB
use DB;

class AuthController extends Controller
{
    //权限列表
    public function index(){
        // 查询数据
        //select t1.*,t2.auth_name as parent_name from auth as t1 left join auth as t2 on t1.pid = t2.id;
        $data = DB::table('auth as t1') -> select('t1.*','t2.auth_name as parent_name') -> leftJoin('auth as t2','t1.pid','=','t2.id') -> get();
        // dd($data);
    	//展示视图
    	return view('admin.auth.index',compact('data'));
    }

    //添加权限
    public function add(){
    	//判断请求类型（get or post）
    	// dd(Input::method());   // GET
    	if(Input::method() == 'POST'){
    		// post
            // 自动验证
            // 写入数据
            // $data = Input::all();
            // unset($data['_token']);
            if(Auth::create(Input::all())){
                $response = ['code' => '0','msg' => '添加权限成功！'];
            }else{
                $response = ['code' => '1','msg' => '添加权限失败！'];
            }
            //返回数据
            return response() -> json($response);
    	}else{
    		// get
            // 获取顶级权限
            $parent = Auth::where('pid',0) -> get();
    		return view('admin.auth.add',compact('parent'));
    	}
    }
}
