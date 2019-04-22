<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('sheet',function($table){
            $table -> increments('id');
            $table -> tinyInteger('paper_id') -> notNull() -> comment('试卷id');
            $table -> tinyInteger('question_id') -> notNull() -> comment('试题id');
            $table -> tinyInteger('member_id') -> notNull() -> comment('会员id');
            $table -> enum('is_correct',[1,2]) -> notNull() -> default('2') -> comment('是否正确');
            $table -> tinyInteger('score') -> notNull() -> default(0) -> comment('得分');
            $table -> string('answer',1) -> nullable() -> comment('用户答案');
            $table -> timestamps();
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
        Schema::dropIfExists('sheet');
    }
}
