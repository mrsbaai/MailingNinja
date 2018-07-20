<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublisherOffers extends Migration
{
    public function up()
    {
        Schema::create('publisher_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publisher_id')->unsigned();
            $table->integer('offer_id')->unsigned();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('publisher_offers');
    }

}

