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

            $table->boolean('is_for_host')->default(false);
            $table->boolean('is_refund')->default(false);
            $table->integer('offer_id');
            $table->integer('vertical_id');
            $table->integer('user_id');
            $table->integer('costumer_id');

            $table->double('payedAmount');
            $table->double('originalAmount');
            $table->string('code')->default('');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('source')->nullable()->default(null);
            $table->string('buyerEmail');
            $table->string('accountId');


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sell_log');
    }


}
