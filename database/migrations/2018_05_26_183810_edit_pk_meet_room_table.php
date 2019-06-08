<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPkMeetRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pk_meet_room', function (Blueprint $table) {
            $table->string('image_room')->nullable()->change();
            $table->string('active')->default(1)->change();
            $table->string('created_by')->nullable()->change();
            $table->string('update_by')->nullable()->change();
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
            $table->dropColumn(['image_room', 'active','created_by','update_by']);
        });
    }
}
