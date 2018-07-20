<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferCountries extends Migration
{
    public function up()
    {
        Schema::create('offer_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('countries_id')->unsigned();
            $table->integer('offer_id')->unsigned();

        });
    }

    public function down()
    {
        Schema::dropIfExists('offer_countries');
    }
}
