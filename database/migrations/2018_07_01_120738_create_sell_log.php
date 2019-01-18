<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellLog extends Migration
{
    public function up()
    {
        Schema::create('sell_log', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('publisher_id')->nullable()->default(null);
            $table->integer('offer_id');
            $table->integer('operation_id');
            $table->integer('costumer_id');
            $table->string('merchant_email');
            $table->double('net_amount');
            $table->double('costume_price');
            $table->string('type')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sell_log');
    }


}
