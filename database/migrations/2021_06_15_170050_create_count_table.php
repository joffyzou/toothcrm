<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('platform_id')->comment('平台ID');
            $table->unsignedSmallInteger('origin_id')->comment('来源ID');
            $table->unsignedSmallInteger('project_zz')->comment('种植');
            $table->unsignedSmallInteger('project_jz')->comment('矫正');
            $table->unsignedSmallInteger('project_qk')->comment('全科');
            $table->unsignedSmallInteger('project_jc')->comment('检查');
            $table->unsignedSmallInteger('project_jy')->comment('洁牙');
            $table->bigInteger('sum')->default(0)->comment('总数');
            $table->boolean('status')->default(0)->comment('状态(0=全部 1=有效)');
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
        Schema::dropIfExists('count');
    }
}
