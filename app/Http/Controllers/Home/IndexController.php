<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Live;
use App\Model\Profession;

class IndexController extends Controller
{
    // 首页
    public function index(){
    	// 查询直播课程列表
    	$live = Live::where('status','1') -> orderBy('sort','desc') -> get();
    	// 查询专业课程列表
    	$profession = Profession::orderBy('sort','desc') -> get();
    	// 处理下直播的状态
    	foreach ($live as $key => $value) {
    		#value是一个对象
    		#直播未开始
    		if(time() < $value -> begin_at){
    			$value -> live_status = '直播未开始';
    		}
    		# 直播已结束
    		if(time() > $value -> end_at){
    			$value -> live_status = '直播已结束';
    		}
    		# 直播中
    		if(time() >= $value -> begin_at && time() <= $value -> end_at){
    			$value -> live_status = '直播中';
    		}
    	}
    	// 展示视图
    	return view('home.index.index',compact('live','profession'));
    }
}
