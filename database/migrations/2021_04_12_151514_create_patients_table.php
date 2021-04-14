<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('姓名');
            $table->string('platform')->comment('平台名称');
            $table->string('phone')->unique()->comment('电话');
            $table->unsignedInteger('admin_id')->index()->comment('Admin ID');
            $table->unsignedInteger('is_appointment')->default(0)->comment('0未预约，1已预约');
            $table->unsignedInteger('is_add_wechat')->default(0)->comment('0未加，1加');
            $table->string('project')->comment('咨询项目');
            $table->unsignedInteger('is_to_store')->default(0)->comment('是否到店');
            $table->string('achievement')->comment('业绩');
            $table->string('note')->nullable()->comment('特殊备注');
            $table->index(['created_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
