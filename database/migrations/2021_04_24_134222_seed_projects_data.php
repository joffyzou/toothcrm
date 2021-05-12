<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedProjectsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $projects = [
            ['name' => '种植'],
            ['name' => '矫正'],
            ['name' => '全科'],
            ['name' => '检查'],
            ['name' => '洁牙']
        ];
        DB::table('projects')->insert($projects);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('projects')->truncate();
    }
}
