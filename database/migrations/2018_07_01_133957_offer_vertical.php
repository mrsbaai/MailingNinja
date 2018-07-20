<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OfferVertical extends Migration
{
    public function up()
    {
        Schema::create('offer_vertical', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id');
            $table->integer('vertical_id');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('offer_vertical');
    }

}
