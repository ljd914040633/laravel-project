<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 后台路由

// 展示登录页面
Route::get('admin/public/login','Admin\PublicController@login') -> name('login');
// 登录表单提交
Route::post('admin/public/check','Admin\PublicController@check') -> name('admin_check_login');


// 后台路由群组简化后台路由写法
Route::group(['prefix' => 'admin','middleware' => ['auth:admin','rbac']], function() {
   	// 后台首页的路由
	Route::get('index/index','Admin\IndexController@index') -> name('dashboard');
	Route::get('index/welcome','Admin\IndexController@welcome') -> name('welcome');
	// 退出路由
	Route::get('index/logout','Admin\IndexController@logout') -> name('logout');

	// 管理员模块
	Route::get('manager/index','Admin\ManagerController@index') -> name('manager_index');

	// 权限管理
	Route::any('auth/add','Admin\AuthController@add') -> name('auth_add');
	Route::get('auth/index','Admin\AuthController@index') -> name('auth_index');

	// 角色管理
	Route::any('role/assign','Admin\RoleController@assign') -> name('role_assign');
	Route::get('role/index','Admin\RoleController@index') -> name('role_index');

	// 会员管理
	Route::get('member/index','Admin\MemberController@index') -> name('member_index');
	Route::any('member/add','Admin\MemberController@add') -> name('member_add');
	Route::post('uploader/webuploader','Admin\UploaderController@webuploader') -> name('webuploader');
	Route::post('uploader/qiniu','Admin\UploaderController@qiniu') -> name('qiniu');
	Route::get('member/getAreaById','Admin\MemberController@getAreaById') -> name('member_getAreaById');

	// 专业部分
	Route::get('protype/index','Admin\ProtypeController@index') -> name('protype_index');
	Route::get('profession/index','Admin\ProfessionController@index') -> name('profession_index');

	// 课程点播部分
	Route::get('course/index','Admin\CourseController@index') -> name('course_index');
	Route::get('lesson/index','Admin\LessonController@index') -> name('lesson_index');
	Route::get('lesson/play','Admin\LessonController@play') -> name('lesson_play');

	// 试卷和四题的部分
	Route::get('paper/index','Admin\PaperController@index') -> name('paper_index');
	Route::get('question/index','Admin\QuestionController@index') -> name('question_index');
	Route::get('question/export','Admin\QuestionController@export') -> name('question_export');
	Route::any('question/import','Admin\QuestionController@import') -> name('question_import');

	// 直播的相关信息
	Route::get('live/index','Admin\LiveController@index') -> name('live_index');
	Route::get('stream/index','Admin\StreamController@index') -> name('stream_index');
	Route::any('stream/add','Admin\StreamController@add') -> name('stream_add');
});

// 前台路由
Route::get('/','Home\IndexController@index') -> name('home_index');
// 直播观看路由
Route::get('live','Home\LiveController@live') -> name('live');
// 专业详情路由
Route::get('showDetail','Home\ProfessionController@showDetail') -> name('showDetail');

// 购买确认页面
Route::get('showOrder','Home\ProfessionController@showOrder') -> name('showOrder');
//pathinfo