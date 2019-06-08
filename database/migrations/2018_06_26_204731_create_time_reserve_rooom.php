<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeReserveRooom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pk_time_reserve_room', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_room_id')->unsigned();
            $table->time('time_reserve');
            $table->date('date_reserve');
            $table->foreign('reserve_room_id')->references('id')->on('pk_reserve_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pk_time_reserve_room');
    }
}
