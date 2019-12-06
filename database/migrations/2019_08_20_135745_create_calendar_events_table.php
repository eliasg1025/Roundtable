<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_events', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title');
			$table->dateTime('date');
			$table->boolean('allDay')->default(false);
			$table->boolean('queue')->default(true);
			$table->string('timezone')->default('America/Lima');
			$table->timestamps();
			// Fks
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			// "other user" hace referencia al usuario que es citado y da su horario
			$table->bigInteger('other_user_id')->unsigned();
			$table->foreign('other_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_events');
    }
}
