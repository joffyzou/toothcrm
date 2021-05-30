<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('platform_id')->default(0)->comment('平台ID');
            $table->integer('valid_target')->default(0)->comment('有效咨询考核目标');
            $table->float('cost_control')->default(0)->comment('成本控制');
            $table->date('created_at')->comment('考核自然月');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checks');
    }
}
