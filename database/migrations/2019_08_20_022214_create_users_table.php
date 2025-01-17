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
            $table->string('uuid', 5)->unique();
            $table->string('slug');
			$table->string('commercial_name')->nullable(); // nombre comercial por defecto debe ser igual a la razon social
			$table->string('ruc', 20)->unique();
            $table->string('legal_registration', 20)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('profile_img')->default('/img/empresa/empresa1/portada_enpresa.jpg');
            $table->string('cover_img')->default('/img/empresa/empresa1/empresa1.jpg');
            $table->text('address')->nullable(); // dato temporal / json
			$table->text('description')->nullable();
            $table->integer('coins')->default(0); //
			$table->tinyInteger('verified')->default(0);
			$table->string('timezone', 30)->default('America/Lima');
            // Contact
            $table->string('hangouts_url')->nullable();
            $table->string('skype_url')->nullable();
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
