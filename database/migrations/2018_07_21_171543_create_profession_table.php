<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('profession',function($table){
            $table -> increments('id');
            $table -> string('pro_name',20) -> notNull() -> comment('专业名称');
            $table -> tinyInteger('protype_id') -> notNull() -> comment('专业分类id');
            $table -> string('teachers_ids') -> notNull() -> comment('授课老师id集合');
            $table -> string('description') -> comment('专业描述');
            $table -> string('cover_img') -> comment('封面地址');
            $table -> integer('view_count') -> notNull() -> default('500') -> comment('点击量');
            $table -> timestamps();
            $table -> tinyinteger('sort') -> notNull() -> default('0') -> comment('排序字段');
            $table -> tinyinteger('duration') -> comment('课时，单位小时');
            $table -> decimal('price',7,2) -> comment('价格');
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
        Schema::dropIfExists('profession');
    }
}
