<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOfferCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('offer_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->string('code')->unsigned();
            $table->foreign('code')->references('code')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_countries');
    }
}
