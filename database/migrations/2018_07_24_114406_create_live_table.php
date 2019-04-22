<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('live',function($table){
            $table -> increments('id');
            $table -> string('live_name',50) -> notNull() -> unique() -> comment('直播课程名称');
            $table -> integer('profession_id') -> notNull() -> comment('所属专业id');
            $table -> integer('stream_id') -> notNull() -> comment('流id');
            $table -> string('cover_img') -> notNull() -> comment('封面');
            $table -> integer('sort') -> notNull() -> default(0)  -> comment('排序');
            $table -> string('description') -> nullable() -> comment('描述');
            $table -> integer('begin_at') -> notNull() -> comment('直播开始时间');
            $table -> integer('end_at') -> notNull() -> comment('直播结束时间');
            $table -> string('video_addr') -> nullable() -> comment('回看视频的地址');
            $table -> timestamps();
            $table -> enum('status',[1,2]) -> notNull() -> default('1') -> comment('直播课程的状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表
        Schema::dropIfExists('live');
    }
}
