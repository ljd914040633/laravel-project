<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Profession;
class ProfessionController extends Controller
{
    // 详情页面
    public function showDetail(Request $request){
    	// 获取数据
    	$data = Profession::where('id',(int) $request -> get('id')) -> first();
    	// 展示页面
    	return view('home.profession.showDetail',compact('data'));
    }

    // 订单确认界面
    public function showOrder(Request $request){
    	// 获取数据
    	$data = Profession::where('id',(int) $request -> get('id')) -> first();
    	// 展示视图
    	return view('home.profession.showOrder',compact('data'));
    }
}
