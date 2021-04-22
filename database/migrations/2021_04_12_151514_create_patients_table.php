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
            $table->string('name')->comment('患者姓名');
            $table->string('platform')->comment('平台名称');
            $table->string('phone')->unique()->index()->comment('患者电话');
            $table->unsignedInteger('admin_id')->index()->comment('管理员ID');
            $table->unsignedInteger('is_appointment')->default(0)->comment('预约(0=否)');
            $table->unsignedInteger('is_add_wechat')->default(0)->comment('加微(0=否)');
            $table->string('project')->comment('咨询项目');
            $table->unsignedInteger('is_to_store')->default(0)->comment('到店(0=否)');
            $table->string('achievement')->nullable()->comment('业绩');
            $table->dateTime('appointment_time')->nullable()->comment('预约时间');
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
