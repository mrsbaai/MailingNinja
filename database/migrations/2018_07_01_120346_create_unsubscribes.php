<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnsubscribes extends Migration
{
    public function up()
    {
        Schema::create('unsubscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->integer('offer_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unsubscribes');
    }


}
