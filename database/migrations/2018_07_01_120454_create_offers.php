<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffers extends Migration
{
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_public')->default(true);
            $table->boolean('is_pay_per_click')->default(false);
            $table->integer('payout')->default(0);
            $table->integer('vertical_id')->default(0);
            $table->string('email')->unique();
            $table->string('title');
            $table->string('description');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offers');
    }


}
