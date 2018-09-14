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
            $table->boolean('is_private')->default(true);
            $table->integer('payout')->default(0);
            $table->string('title')->default('Untitled');
            $table->string('thumbnail')->nullable()->default(null);
            $table->longText('description')->nullable();
            $table->longText('landing_a')->nullable();
            $table->longText('landing_b')->nullable();
            $table->integer('profit_a')->default(0);
            $table->integer('profit_b')->default(0);
            $table->integer('subscribes_a')->default(0);
            $table->integer('subscribes_b')->default(0);
            $table->longText('promo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offers');
    }


}
