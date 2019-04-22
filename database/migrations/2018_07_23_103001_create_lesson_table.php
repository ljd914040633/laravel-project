<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('lesson',function($table){
            $table -> increments('id');
            $table -> string('lesson_name',50) -> notNull() -> comment('点播课程名称');
            $table -> integer('course_id') -> notNull() -> comment('课程id');
            $table -> integer('video_time') -> notNull() -> comment('视频时长');
            $table -> string('video_addr') -> notNull() -> comment('视频地址');
            $table -> integer('sort') -> notNull() -> default(0) -> comment('排序');
            $table -> string('description') -> notNull() -> comment('描述');
            $table -> timestamps();
            $table -> enum('status',[1,2]) -> notNull() -> default('2') -> comment('状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除
        Schema::dropIfExists('lesson');
    }
}
