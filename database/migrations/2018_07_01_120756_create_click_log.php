<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClickLog extends Migration
{
    public function up()
    {
        Schema::create('click_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('offer_id');
            $table->integer('vertical_id');
            $table->integer('count');
            $table->date('day');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('click_log');
    }


}
