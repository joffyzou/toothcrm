<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('部门ID');
            $table->string('name')->comment('部门名称');
            $table->unsignedSmallInteger('level')->default(1)->comment('部门级别,最高1开始');
            $table->unsignedSmallInteger('parent_id')->default(0)->comment('上级部门ID');
            $table->unsignedSmallInteger('user_id')->default(0)->comment('部门经理用户ID');
            $table->string('user_name')->nullable()->comment('部门经理用户名');
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
        Schema::dropIfExists('departments');
    }
}
