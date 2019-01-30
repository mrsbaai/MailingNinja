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
            $table->decimal('payout',6,2)->default(0);

            $table->longText('landing_a')->nullable();
            $table->longText('landing_b')->nullable();
            $table->longText('promo')->nullable();
            $table->string('title')->default('Untitled');
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();



            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('image_6')->nullable();
            $table->string('image_7')->nullable();
            $table->string('image_8')->nullable();
            $table->string('image_9')->nullable();
            $table->string('image_0')->nullable();
            $table->string('author_image')->nullable();
            $table->string('author_name')->nullable();
            $table->string('subtitle')->nullable();

            $table->longText('author_about')->nullable();
            $table->longText('book_about_1')->nullable();
            $table->longText('book_about_2')->nullable();
            $table->longText('book_about_3')->nullable();

            $table->string('review_name_1')->nullable();
            $table->string('review_content_1')->nullable();
            $table->string('review_name_2')->nullable();
            $table->string('review_content_2')->nullable();
            $table->string('review_name_3')->nullable();
            $table->string('review_content_3')->nullable();
            $table->string('review_name_4')->nullable();
            $table->string('review_content_4')->nullable();
            $table->string('review_name_5')->nullable();
            $table->string('review_content_5')->nullable();
            $table->string('review_name_6')->nullable();
            $table->string('review_content_6')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offers');
    }


}
