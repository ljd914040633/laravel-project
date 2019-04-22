<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('stream',function($table){
            $table -> increments('id');
            $table -> string('stream_name',200) -> notNull() -> comment('流名称');
            $table -> enum('status',[1,2,3]) -> notNull() -> default('1') -> comment('禁播状态');
            $table -> integer('permited_at') -> notNull() -> default(0) -> comment('恢复直播时间');
            $table -> integer('sort') -> notNull() -> default(0) -> comment('排序');
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
        Schema::dropIfExists('stream');
    }
}
