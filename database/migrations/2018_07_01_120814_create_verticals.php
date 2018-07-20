<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerticals extends Migration
{
    public function up()
    {
        Schema::create('verticals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vertical')->unique();
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verticals');
    }


}
