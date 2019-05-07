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

        Schema::dropIfExists('offer_countries');
        Schema::create('offer_countries', function (Blueprint $table) {
            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->string('country_code')->unsigned();
            $table->foreign('country_code')->references('code')->on('countries');

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
