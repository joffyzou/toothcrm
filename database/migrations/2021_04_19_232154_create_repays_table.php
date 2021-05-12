<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repays', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('员工ID');
            $table->unsignedInteger('patient_id')->comment('患者ID');
            $table->string('repay')->comment('回访详情');
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
        Schema::dropIfExists('repays');
    }
}
