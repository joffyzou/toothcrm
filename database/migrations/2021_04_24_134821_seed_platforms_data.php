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
            ['name' => '平台A'],
            ['name' => '平台B'],
            ['name' => '平台C'],
            ['name' => '平台D']
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
