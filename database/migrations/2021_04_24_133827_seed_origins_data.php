<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedOriginsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $origins = [
            ['name' => '电话'],
            ['name' => '对话'],
            ['name' => '表单']
        ];
        DB::table('origins')->insert($origins);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('origins')->truncate();
    }
}
