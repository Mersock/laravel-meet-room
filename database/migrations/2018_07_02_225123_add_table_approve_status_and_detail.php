<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableApproveStatusAndDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pk_reserve_room', function (Blueprint $table) {
            $table->text('detail')->nullable()->after('title');
            $table->char('approve_status',1)->default(0)->after('room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pk_reserve_room', function (Blueprint $table) {
            $table->dropColumn(['detail','approve_status']);
        });
    }
}
