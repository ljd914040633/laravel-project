<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Stream;
// 引入Input
use Input;
// 引入guzzle
use GuzzleHttp\Client;

class StreamController extends Controller
{
    // 列表
    public function index(){
    	// 获取数据
    	$data = Stream::orderBy('sort','desc') -> get();
    	// 展示视图并且传递参数
    	return view('admin.stream.index',compact('data'));
    }

    /**
     * @Author      Y
     * @DateTime    2018-07-24
     * @Description [Description]
     */
    public function add(){
    	if(Input::method() == 'POST'){
    		// 负责表单数据的提交和七牛数据的同步
    		$data = Input::except(['_token']);
    		// 生成七牛token
    		// 定义变量
    		$method = "POST";
    		$path = "/v2/hubs/education-zet/streams";
    		$host = "pili.qiniuapi.com";
    		$contentType = "application/json";
    		$body = json_encode(['key' => $data['stream_name']]);
    		// 拼凑字符串
    		$str = "$method $path\nHost: $host\nContent-Type: $contentType\n\n$body";
    		// 实例化七牛SDK其中Auth类
    		$auth = new \Qiniu\Auth(config('filesystems.disks.qiniu.access_key'),config('filesystems.disks.qiniu.secret_key'));
    		// 签名
    		$qiniuToken = "Qiniu " . $auth -> sign($str);
    		// 开始请求（使用Guzzle进行请求）
    		$client = new Client([
			    // 基础地址用于进行相对路径请求的
			    'base_uri' => 'http://' . $host  // http://pili.qiniuapi.com
			]);
			// 开始请求，相当于相对请求表格中的第一种情况
			$res = $client -> post($path,[
				// 请求头和请求体
				'headers'	=>	[
					'Authorization'	=>	$qiniuToken,
					'Content-Type'	=>	$contentType,
				],
				'body'		=>	$body,
			]);
			// 判断响应是否成功
			if($res -> getStatusCode() == '200'){
				//进行数据的入表
	    		$data['permited_at'] = (int) strtotime($data['permited_at']);
	    		// 写入数据
	    		if(Stream::insert($data)){
	    			// 提示成功
	    			$response = ['code' => 0,'msg' => '添加流成功！'];
	    		}else{
	    			// 提示失败
	    			$response = ['code' => 1,'msg' => '添加流失败！'];
	    		}
			}else{
				// 状态码不是200
				$response = ['code' => 2,'msg' => '接口调用失败！'];
			}
    		return response() -> json($response);
    	}else{
    		// 展示视图
    		return view('admin.stream.add');
    	}
    }
}
