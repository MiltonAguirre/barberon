<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
          $table->string('role');
          $table->string('username')->unique();
          $table->string('password');
          $table->string('image');
          // $table->string('api_token', 80)->unique()->nullable()->default(null);
          $table->unsignedInteger('location_id');
          $table->unsignedInteger('data_user_id');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::table('users', function($table) {
        $table->foreign('data_user_id')->references('id')->on('data_users')->onDelete('cascade');
        $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
