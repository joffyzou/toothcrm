<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            ['name' => '大众', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '天猫', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '阿里健康', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '口碑', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '新氧', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '京东', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '更美', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '悦美', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '拼多多', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '美呗', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '牙么么', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '美帮', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '无忧爱美', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '笑颜', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '诺美尔', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '爱牙无忧', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '美貌', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '高济医疗', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '倾尔美', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '牙蜜儿', 'created_at' => now(), 'updated_at' => now()]
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
