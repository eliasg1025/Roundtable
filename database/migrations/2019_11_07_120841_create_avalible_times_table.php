<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvalibleTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avalible_times', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title', 20)->default('Disponible');
			$table->string('groupId', 20)->default('freeTime');
			$table->text('daysOfWeek');
			$table->time('startTime');
			$table->time('endTime');
			$table->string('color', 20)->default('#32a862');
			$table->timestamps();
			// Fks
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avalible_times');
    }
}
