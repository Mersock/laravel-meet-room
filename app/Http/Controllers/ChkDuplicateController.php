<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//model
use App\model\set_meet_room\meet_room;
use App\model\set_meet_room\type_room;
use App\model\set_meet_room\set_time;
use App\model\reserve_room\reservation_details;

//lib
use App\Helpers\lib;

//
use DB;
use Form;

class ChkDuplicateController extends Controller
{
    public function check_code_room(Request $request){
        if($request->ajax()){
                $count_code_room = lib::ChkDuplicate('pk_meet_room','code_room',$request->code);
                return response($count_code_room);          
        }
    }

    public function check_email_user(Request $request){
        if($request->ajax()){
                $count_email = lib::ChkDuplicate('users','email',$request->code."@ppk.com");
                return response($count_email);
        }
    }

    public function check_code_user(Request $request){
        if($request->ajax()){
                $count_user = lib::ChkDuplicate('users','code_user',$request->code);
                return response($count_user);
        }
    }

    public function check_type_room(Request $request){
        if($request->ajax()){
                $count_user = lib::ChkDuplicate('pk_type_room','code_type',$request->code);
                return response($count_user);
        }
    }
    public function check_time_reserve(Request $request){
        if($request->ajax()){
            $date = lib::date_to_db($request->date);
            $room = $request->room;
            $subQuery = DB::table('pk_time_reserve')
                        ->whereNotIn('time_hour',DB::table('pk_time_reserve_room')->whereDate('date_reserve',$date)->pluck('time_reserve'))
                        ->toSql();
                        return  $subQuery;
            

           
        }
    }
}
