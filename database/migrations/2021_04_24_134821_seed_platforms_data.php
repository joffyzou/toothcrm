<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedPlatformsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $platforms = [
            ['name' => '大众'],
            ['name' => '天猫'],
            ['name' => '阿里健康'],
            ['name' => '口碑'],
            ['name' => '新氧'],
            ['name' => '京东'],
            ['name' => '更美'],
            ['name' => '悦美'],
            ['name' => '拼多多'],
            ['name' => '美呗'],
            ['name' => '牙么么'],
            ['name' => '美帮'],
            ['name' => '无忧爱美'],
            ['name' => '笑颜'],
            ['name' => '诺美尔'],
            ['name' => '爱牙无忧'],
            ['name' => '美貌'],
            ['name' => '高济医疗'],
            ['name' => '倾尔美'],
            ['name' => '牙蜜儿']
        ];
        DB::table('platforms')->insert($platforms);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('platforms')->truncate();
    }
}
