<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('protype',function($table){
            $table -> increments('id');//主键id
            $table -> string('protype_name',20) -> notNull() -> comment('专业分类名称');
            $table -> tinyInteger('sort') -> notNull() -> default('0') -> comment('排序字段，降序');
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
        //删表
        Schema::dropIfExists('protype');
    }
}
