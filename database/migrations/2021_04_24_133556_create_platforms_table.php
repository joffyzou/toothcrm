<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('平台ID');
            $table->string('name')->comment('平台名称');
            $table->unsignedInteger('user_id')->default(0)->index()->comment('平台负责人');
            $table->integer('valid_target')->default(0)->comment('有效咨询考核目标');
            $table->float('cost_control')->default(0)->comment('成本控制');
            $table->date('created_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
