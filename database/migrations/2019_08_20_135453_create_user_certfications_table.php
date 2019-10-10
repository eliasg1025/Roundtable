<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCertficationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_certfications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 30);
            $table->mediumText('description')->nullable();
			$table->string('url');
			$table->string('name_file');
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
        Schema::dropIfExists('user_certfications');
    }
}
