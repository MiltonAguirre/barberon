<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table ->time('open');
            $table ->time('close');
            $table ->time('open_b')->nullable()->default(null);
            $table ->time('close_b')->nullable()->default(null);
            $table->unsignedInteger('barber_id');
            $table->timestamps();
        });
        Schema::table('days', function($table) {
            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
