<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Live;
class LiveController extends Controller
{
    // 直播观看
    public function live(Request $request){
    	// 获取需要直播的课程id
    	$id = (int) $request -> get('id');
    	// 查询记录
    	$data = Live::where('id',$id) -> where('begin_at','<=',time()) -> where('end_at','>=',time()) -> first();
    	// 判断是否可以看直播
    	if($data){
    		// 有直播
    		return view('home.live.live',compact('data'));
    	}else{
    		// 没有直播可以观看
    		return "<script>alert('抱歉，没有对应的直播课程可以观看');location.href='/';</script>";exit;
    	}
    }
}
