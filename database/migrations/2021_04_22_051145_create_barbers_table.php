<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('phone');
          $table->unsignedInteger('location_id');
          $table->unsignedInteger('user_id');
          $table->timestamps();
      });
      Schema::table('barbers', function($table) {
        $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barbers');
    }
}
