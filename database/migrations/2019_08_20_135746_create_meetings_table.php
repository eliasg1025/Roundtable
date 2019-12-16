<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('title', 150);
			$table->string('message')->nullable();
			$table->datetime('date');
			$table->integer('duration')->nullable();
			$table->integer('max_duration')->default(30);
			$table->boolean('allDay')->default(false);
			$table->string('timezone', 30)->default('America/Lima');
			$table->string('link')->nullable();
            $table->timestamps();
            // Fks
            $table->bigInteger('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('users');
            $table->bigInteger('receiver_id')->unsigned();
			$table->foreign('receiver_id')->references('id')->on('users');
            $table->bigInteger('state_id')->unsigned();
			$table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
