<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('管理员ID');
            $table->string('username')->unique()->comment('登录名');
            $table->unsignedSmallInteger('role_id')->default(0)->comment('角色ID');
            $table->string('password')->comment('登录密码');
            $table->boolean('is_admin')->default(false)->comment('超管(0=否)');
            $table->unsignedSmallInteger('p_id')->default(0)->comment('父ID');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
