<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start', $precision = 0);
            $table->string('state')->default('active');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('barber_id');


            $table->timestamps();
        });
        Schema::table('turns', function($table) {
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('product_id')->references('id')->on('products');
          $table->foreign('barber_id')->references('id')->on('barbers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turns');
    }
}
