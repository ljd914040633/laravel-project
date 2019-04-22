<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //生成faker实例
        $faker = \Faker\Factory::create('zh_CN');
        // 定义空数组，存放数据
        $data = [];
        // 循环生成数据
        for ($i = 0; $i < 100; $i++) { 
        	$data[] = [
        		'username'		=>	$faker -> userName,
        		'password'		=>	bcrypt('123456'),
        		'gender'		=>	rand(1,3),
        		'avatar'		=>	'/statics/avatar.jpg',
        		'mobile'		=>	$faker -> phoneNumber,
        		'email'			=>	$faker -> email,
        		'created_at'	=>	date('Y-m-d H:i:s'),
        		'type'			=>	rand(1,2),
        		'status'		=>	rand(1,2)
        	];
        }
        // 写入数据表
        DB::table('member') -> insert($data);
    }
}
