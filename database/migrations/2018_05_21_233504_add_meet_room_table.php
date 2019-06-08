<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMeetRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pk_meet_room', function (Blueprint $table) {
            $table->integer('type_id')->after('image_room')->unsigned();
            $table->char('active',1)->after('type_id');
            $table->string('created_by');
            $table->string('update_by');
            $table->foreign('type_id')->references('id')->on('pk_type_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pk_meet_room',function($table){
            $table->dropColumn(['type_id', 'active','created_by','update_by']);
        });
    }
}
