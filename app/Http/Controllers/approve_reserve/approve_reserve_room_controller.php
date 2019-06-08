<?php

namespace App\Http\Controllers\approve_reserve;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//lib
use App\Helpers\lib;
//DB
use DB;

use App\model\reserve_room\reservation_details;
use App\model\set_meet_room\meet_room;
use App\model\reserve_room\time_room_reserve;

class approve_reserve_room_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //หน้าแสดงรายการ
    public function index(Request $request){

        $cond = [];
        $room_id = [];
        $reserve_date = [];
        if($request->room){
           $room_id = [['room_id','=',$request->room]]; 
        }
        if($request->reserve_date){
            $reserve_date = [['reserve_date','=',lib::date_to_db($request->reserve_date)]];
        }

        $cond =  array_merge($room_id,$reserve_date);
        
        $reserive_detail = reservation_details::where('approve_status',0)
                                                ->where($cond)
                                                ->orderBy('reserve_date','desc')
                                                ->orderBy('id','desc')
                                                ->get();


        $room = meet_room::Meet_Room_Active()->pluck('name_room','id');

        $time_reserve = time_room_reserve::Get_Time_Room()->get();

        $get_time_reserv = [];
        foreach($time_reserve as $time){
            $reserve_time = explode(":",$time->time_reserve);
            $get_time_reserv[$time->reserve_room_id][$reserve_time[0].":".$reserve_time[1]] = $reserve_time[0].":".$reserve_time[1];
        }

        return view('approve_reserve.approve_reserve_room.index',compact(['reserive_detail','room','get_time_reserv']) );
    }


    
    //process อนุมัติ
    public function approve(Request $request){

            $request->validate([
                'approve_status' =>  'required',
                'reserve' => 'required'
            ]);

            $reserive_detail = reservation_details::find($request->reserve);
            
            $reserive_detail->approve_status = $request->input('approve_status');
            $reserive_detail->updated_by = lib::GetUser();
            $reserive_detail->save();

            return redirect()->route('approve_reserve_room.index');

    }
}
