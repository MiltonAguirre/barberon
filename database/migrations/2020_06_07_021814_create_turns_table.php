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
            $table->string('state');
            $table->time('hour');
            $table->date('date');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('barber_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();
        });
        Schema::table('turns', function($table) {
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
