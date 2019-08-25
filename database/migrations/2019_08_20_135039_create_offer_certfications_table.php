<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferCertficationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_certfications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 30);
            $table->mediumText('description')->nullable();
            $table->string('url');
            $table->timestamps();
            // Fks
            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_certfications');
    }
}
