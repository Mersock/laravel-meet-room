<?php

namespace App\Http\Controllers\approve_reserve;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//model
use App\model\reserve_room\reservation_details;
use App\model\set_meet_room\meet_room;
use App\model\reserve_room\time_room_reserve;
//lib
use lib;

//authen
use Auth;

//DB
use DB;

class approve_reserve_detail_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $reserive_detail = reservation_details::where('user_id',Auth::user()->id)
        ->whereYear('reserve_date',date('Y'))
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

        $arr_img_approve = [
            0 => 'images/wait.png',
            1 => 'images/accept.png',
            2 => 'images/block.png',
            3 => 'images/delete.png',
        ];

        return view('approve_reserve.approve_reserve_detail.index',compact(['reserive_detail','get_time_reserv','arr_img_approve','room']) );
        //     'reserive_detail' => $reserive_detail,
        //     'get_time_reserv' => $get_time_reserv,
        //     'arr_img_approve' => $arr_img_approve,
        //     'room' => $room,
        // ]);
    }

    public function edit($id){
        $reserv = reservation_details::find($id);
        // เวลาที่เคยจอง
        $time_use = DB::table('pk_time_reserve_room')
                        ->select('time_reserve as time')
                        ->join('pk_reserve_room','pk_reserve_room.id','=','pk_time_reserve_room.reserve_room_id')
                        ->where('reserve_room_id',$id)
                        ->get();

        $get_time_use = [];
            foreach($time_use as $use_time){
                $use = explode(':',$use_time->time);
                $get_time_use[$use[0].":".$use[1]] = $use[0].":".$use[1];
            }

        //เวลาทั้งหมด
        $room_id = $reserv->room_id;

        $reserve_date = $reserv->reserve_date;

        $sql_use = DB::table('pk_time_reserve_room')
                    ->select('time_reserve as time')
                    ->join('pk_reserve_room','pk_reserve_room.id','=','pk_time_reserve_room.reserve_room_id')
                    ->where('reserve_room_id',$id);

        $time_all = DB::table('pk_time_reserve')
                    ->select('time_hour as time')
                    ->whereNotIn('time_hour',function($query) use($room_id,$reserve_date) {
                                $query->select('time_reserve')
                                      ->from('pk_time_reserve_room')
                                      ->join('pk_reserve_room','pk_reserve_room.id','=','pk_time_reserve_room.reserve_room_id')
                                      ->where('room_id',$room_id)
                                      ->whereDate('reserve_date',$reserve_date)
                                      ->whereIn('approve_status',[0,1]);
                    })
                    ->union($sql_use)
                    ->get();

         $get_time_all =[];
             foreach($time_all as $all_time){
                 $all = explode(':',$all_time->time);

                 $get_time_all[$all[0].":".$all[1]] = $all[0].":".$all[1];

             }    

        return view('approve_reserve/approve_reserve_detail/edit',compact(['reserv','get_time_use','get_time_all']) );
        //  'reserv' => $reserv,
        //  'get_time_use' => $get_time_use,
        //  'get_time_all' => $get_time_all
        // ]);
    }

    public function update(Request $request){
        $request->validate([
            'time'  => 'required|array',
            'title' =>  'required|max:190',
         ]);

         //ลบเวลาจองเดิมออก
         DB::table('pk_time_reserve_room')->where('reserve_room_id','=',$request->reserv_id)->delete();

         $reserve = reservation_details::find($request->reserv_id);

         $reserve->title = $request->input('title');
         $reserve->detail = $request->input('detail');
         $reserve->approve_status = $request->input('status');
         $reserve->updated_by = lib::GetUser();
         $reserve->save();

         $reserve_room_id = $reserve->id;
         $date = $reserve->reserve_date;

         if(count($request->time)>0){
             foreach($request->time as $times){
                $time = new time_room_reserve;
                $time->reserve_room_id = $reserve_room_id;
                $time->time_reserve = $times;
                $time->date_reserve = $date;
                $time->save();
             }
         }

        return redirect()->route('approve_reserve_detail.index');
    }
}
