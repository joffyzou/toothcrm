<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sums', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('platform_id')->comment('平台ID');
            $table->unsignedSmallInteger('origin_id')->comment('来源ID');
            $table->bigInteger('origin_sum')->default(0)->comment('来源总数');
            $table->bigInteger('valid_sum')->default(0)->comment('有效总数');
            $table->date('created_at')->default(now())->comment('日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sums');
    }
}
