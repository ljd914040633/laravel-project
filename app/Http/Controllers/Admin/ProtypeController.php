<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Protype;

class ProtypeController extends Controller
{
    // 列表
    public function index(){
    	// 获取数据
    	$data = Protype::orderBy('sort','desc') -> get();//dd($data);
    	// 展示视图（携带数据）
    	return view('admin.protype.index',compact('data'));
    }
}
