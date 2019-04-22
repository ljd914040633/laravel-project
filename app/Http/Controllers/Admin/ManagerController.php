<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Manager;

class ManagerController extends Controller
{
    //管理员列表
    public function index(){
    	// 获取数据
    	$data = Manager::all();
    	// 展示视图
    	return view('admin.manager.index',compact('data'));
    }
}
