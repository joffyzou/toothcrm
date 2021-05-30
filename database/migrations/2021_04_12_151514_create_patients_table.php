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
            $table->string('name')->index()->comment('姓名');
            $table->string('phone')->unique()->index()->comment('电话');
            $table->unsignedSmallInteger('user_id')->default(0)->index()->comment('管理员ID(0=公海)');
            $table->boolean('state')->default(true)->comment('状态(0=无效)');
            $table->unsignedSmallInteger('platform_id')->nullable()->comment('平台ID');
            $table->unsignedSmallInteger('origin_id')->nullable()->comment('来源ID');
            $table->unsignedSmallInteger('project_id')->nullable()->comment('项目ID');
            $table->boolean('is_appointment')->default(false)->index()->comment('预约(0=否)');
            $table->boolean('is_add_wechat')->default(false)->index()->comment('加微(0=否)');
            $table->boolean('is_to_store')->default(false)->index()->comment('到店(0=否)');
            $table->boolean('is_introduce_intention')->default(false)->index()->comment('介绍意向(0=否)');
            $table->boolean('is_introduce')->default(false)->index()->comment('介绍(0=否)');
            $table->string('introducer')->nullable()->comment('介绍人');
            $table->float('achievement')->nullable()->comment('业绩');
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
