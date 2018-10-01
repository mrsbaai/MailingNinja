<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')->default(false);
            $table->integer('manager_id')->nullable()->default(null);
            $table->string('paypal')->nullable()->default(null);
            $table->string('skype')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('message')->nullable()->default(null);

            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('country',2)->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('postal_code')->nullable()->default(null);
            $table->string('merchant_id')->nullable()->default(null);
            $table->string('website')->nullable()->default(null);






            $table->integer('balance')->default(0);
            $table->integer('life_time_profit')->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }



}