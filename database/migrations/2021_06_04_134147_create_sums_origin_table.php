<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumsOriginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sums_origin', function (Blueprint $table) {
            $table->bigInteger('sums_id')->comment('总数ID');
            $table->unsignedSmallInteger('project_id')->comment('项目ID');
            $table->unsignedSmallInteger('origin_id')->comment('来源ID');
            $table->bigInteger('number')->comment('数量');
            $table->date('created_at')->comment('日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sums_origin');
    }
}
