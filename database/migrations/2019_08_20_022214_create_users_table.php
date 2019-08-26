<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name'); // razon social
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            // Otros datos
            $table->string('ruc', 20);
            $table->string('legal_registration', 20);
            $table->string('phone', 30);
            $table->string('profile_img')->default('/img/empresa/empresa1/portada_enpresa.jpg');
            $table->string('cover_img')->default('/img/empresa/empresa1/empresa1.jpg');
            $table->string('address'); // dato temporal
            $table->text('description')->nullable();
            $table->integer('coins')->default(0); //
            $table->double('rating')->default(0); //
            $table->integer('views')->default(0);
            // Fks
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types');
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
