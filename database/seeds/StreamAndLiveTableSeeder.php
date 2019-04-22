<?php

use Illuminate\Database\Seeder;

class StreamAndLiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // stream表数据模拟
        DB::table('stream') -> insert([
		    'stream_name'		=>		'sh09',
		    'status'			=>		'2',
		]);
		DB::table('stream') -> insert([
		    'stream_name'		=>		'test',
		    'status'			=>		'3',
		    'permited_at'		=>		strtotime('2017-08-18 10:52')
		]);
		DB::table('stream') -> insert([
		    'stream_name'		=>		'sh10',
		    'status'			=>		'1',
		]);

		// 直播课程的模拟
		DB::table('live') -> insert([
		    'live_name'		=>		'北京全栈06期基础班直播课程',
		    'profession_id'	=>		'1',
		    'stream_id'		=>		3,
		    'cover_img'		=>		'/statics/demo.jpg',
		    'description'	=>		'该课程是主要为了全栈06期基础班课程直播，以供远程同学听课',
		    'begin_at'		=>		strtotime(date('2018-6-19 00:00:00')),
		    'end_at'		=>		strtotime(date('2018-7-20 18:00:00')),
		]);

		DB::table('live') -> insert([
		    'live_name'		=>		'北京全栈06期就业班直播课程',
		    'profession_id'	=>		'2',
		    'stream_id'		=>		3,
		    'cover_img'		=>		'/statics/demo.jpg',
		    'description'	=>		'该课程是主要为了全栈06期就业班课程直播，以供远程同学听课',
		    'begin_at'		=>		strtotime(date('2018-7-22 00:00:00')),
		    'end_at'		=>		strtotime(date('2019-2-28 18:00:00')),
		]);
    }
}
