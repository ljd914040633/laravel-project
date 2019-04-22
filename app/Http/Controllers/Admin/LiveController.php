<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Live;

class LiveController extends Controller
{
    // 列表方法
    public function index(){
    	// 获取数据
    	$data = Live::orderBy('sort','desc') -> get();
    	// 展示视图
    	return view('admin.live.index',compact('data'));
    }
}
