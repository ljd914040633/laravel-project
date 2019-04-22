<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型
use App\Model\Question;
// 引入excel类
use Excel;
// 引入input
use Input;

class QuestionController extends Controller
{
    // 列表
    public function index(){
    	// 获取数据
    	$data = Question::get();
    	// 展示视图
    	return view('admin.question.index',compact('data'));
    }

    // 导出
    public function export(){
    	// 查询试题的数据表
    	$data = Question::get();
    	// 定义一个变量
    	$cellData = [
            ['序号','题干','所属试卷','分值','选项','答案','添加时间']
        ];
        // 循环
        foreach ($data as $key => $value) {
        	$cellData[] = [
        			$value -> id,$value -> question,$value -> rel_paper -> paper_name,$value -> score,$value -> options,$value -> answer,$value -> created_at
        	];
        }
        // dd($cellData);
        // 调用excel类创建一个excel文件
        Excel::create('试题导出',function($excel) use ($cellData){
        	// 创建一个工作表
            $excel->sheet('题库', function($sheet) use ($cellData){
            	// 将数据写入到行里
                $sheet->rows($cellData);
            });// 导出文件
        })->export('xls');
    }

    // 试题的导入
    public function import(){
    	// 判断请求类型
    	if(Input::method() == 'POST'){
    		// post
    		$post = Input::all();
    		//load方法基于项目根路径作为根目录，需要对中文进行了转码，否则会提示文件不存在。
    		$filePath = '.' . $post['excelpath'];
		    Excel::load($filePath, function($reader) use ($post) {
		        // $data = $reader->all();
		        $data = $reader -> getSheet(0) -> toArray();
		        // 写入数据表
		        $arr = [];
		        foreach ($data as $key => $value) {
		        	// 跳过表头
		        	if($key == 0){
		        		continue;
		        	}
		        	$arr[] = [
		        		'question'	=>	$value[0],// 题干
		        		'paper_id'	=>	$post['paper_id'],//试卷id
		        		'score'		=>	(int) $value[3],//分值
		        		'options'	=>	$value[1],//选项
		        		'answer'	=>	$value[2],//答案
		        		'created_at'=>	date('Y-m-d H:i:s')//时间
		        	]; 
		        }
		        // 写入数据
		        if(Question::insert($arr)){
		        	$response = 0;
		        }else{
		        	$response = 1;
		        }
		        // return response() -> json($response); 该方法在这里不好用
		        echo $response;
		    });
    	}else{
    		// get
    		// 查询试卷列表
    		$paper = \App\Model\Paper::select('id','paper_name') -> get();
    		return view('admin.question.import',compact('paper'));
    	}
    }
}
