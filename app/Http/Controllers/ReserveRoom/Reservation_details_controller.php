<?php

namespace App\Http\Controllers\ReserveRoom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//model
use App\model\reserve_room\reservation_details;
use App\model\reserve_room\time_room_reserve;
use App\model\set_meet_room\meet_room;
use App\model\set_meet_room\type_room;
use App\model\set_meet_room\set_time;
//lib
use lib;
//FORM
use Form;
//DB
use DB;
//authen
use Auth;

class Reservation_details_controller extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }



    //แสดงห้องที่จอง
    public function index(Request $request){
    
    $cond = [];
    $s_date = [];    
    $s_room = [];
    $s_type_room = [];
    //ค้นหาวันที่
    if($request->s_date){
        $s_date  = [['date_reserve','=',lib::date_to_db($request->s_date)]];
    }else{
        $s_date  = [['date_reserve','=',date("Y-m-d")]];
    }
    //ค้นหาห้อง
    if($request->s_room){
        $s_room = [['name_room','like',"%".$request->s_room."%"]];
    }
    //ค้นหาประเภทห้อง
    if($request->s_type_room){
        $s_type_room = [['type_id','=',$request->s_type_room]];
    }

    $date_show = ( isset($request->s_date) )?$request->s_date:date("d/m/Y");
    $conv_date = explode("/",$date_show);
    //เปรียบเทียบเวลาให้จองเฉพาะวันปัจจุบันเป็นต้นไป
    $compare_date = $conv_date[2]."/".$conv_date[1]."/".$conv_date[0];

    $cond = array_merge($s_room,$s_type_room);

     // กำหนดช่องเวลา 
    $time_room = set_time::Get_Time()->get();
    $timeArr = [];
    if(count($time_room)>0){
        foreach($time_room as $time){
            $hour = explode(":",$time->time_hour);
            $timeArr[] = $hour[0].":".$hour[1];
        }
    }

    //รายการห้อง
    $rooms = meet_room::Meet_Room_Active()
                        ->where($cond)
                        ->orderBy('id','asc')  
                        ->get();
    //รายการจอง
    $reserve_room = time_room_reserve::Get_Time_Room()
                        ->join('pk_reserve_room','pk_time_reserve_room.reserve_room_id','=','pk_reserve_room.id')
                        ->where($s_date)
                        ->whereIn('approve_status',[0,1])
                        ->get();

    $type_room = type_room::Type_Room_active()->pluck('type_name','id');                                    

    //ช่วงเวลาที่จองและที่ว่าง
    $get_reseve = [];
    if(count($reserve_room)>0){
        foreach($reserve_room as $room){
            $time = explode(":",$room->time_reserve);
            $get_reseve[$room->reservation_details->room_id]['time'][$time[0].":".$time[1]]  = $time[0].":".$time[1];
            $get_reseve[$room->reservation_details->room_id]['title'][$time[0].":".$time[1]] = $room->reservation_details->title;
            $get_reseve[$room->reservation_details->room_id]['detail'][$time[0].":".$time[1]] = $room->reservation_details->detail;
            $get_reseve[$room->reservation_details->room_id]['approve'][$time[0].":".$time[1]] = $room->reservation_details->approve_status;
        }
    }

        return view('reserve_room.reservation_details.index',compact(['timeArr','reserve_room','rooms','get_reseve','date_show','compare_date']) );
        //     'timeArr' => $timeArr,
        //     'reserve_room' => $reserve_room,
        //     'rooms' => $rooms,
        //     'get_reseve' => $get_reseve,
        //     'date_show' => $date_show,
        //     'compare_date' => $compare_date,
        // ]);
    }





    //หน้าทำรายการจอง
    public function reserve(Request $request,$id){
       $room = meet_room::find($id);
       //-- กำหนดช่องเวลา 
       $date_req = ($request->date_reserve!="")?$request->date_reserve:date("Y-m-d");
    //    ไม่เอาเวลาที่ยกเลิกไปแล้วและไม่อนุมัติ
        $time_room = DB::table('pk_time_reserve')
                    ->select('time_hour')
                    ->whereNotIn('time_hour',function($query) use ($id,$date_req){
                            $query->select('time_reserve')
                                  ->from('pk_time_reserve_room')
                                  ->join('pk_reserve_room','pk_time_reserve_room.reserve_room_id','pk_reserve_room.id')
                                  ->where('pk_reserve_room.room_id',$id) 
                                  ->whereIn('pk_reserve_room.approve_status',[0,1])
                                  ->whereDate('pk_reserve_room.reserve_date','=',lib::date_to_db($date_req));
                    })->get();
        
       $timeArr = [];
       foreach($time_room as $time){
           $hour = explode(":",$time->time_hour);
           $timeArr[$hour[0].":".$hour[1]] = $hour[0].":".$hour[1];
       }
        return view('reserve_room.reservation_details.reserve_room',compact(['room','timeArr','date_req']) );
        //     'room' => $room,
        //     'timeArr' => $timeArr,
        //     'date_req' => $date_req,
            
        // ]);
    }




    //process การจอง
    public function reserve_create(Request $request){
        // dd($request);

            $request->validate([
                'time'  => 'required|array',
                'title' =>  'required|max:190',
             ]);

            $reserve = new reservation_details();

            $reserve->title = $request->title;
            $reserve->detail = $request->detail;
            $reserve->reserve_date = lib::date_to_db($request->date);
            $reserve->user_id = Auth::user()->id;
            $reserve->room_id = $request->room_id;
            $reserve->created_by = lib::GetUser();

            $reserve->save();
            $reservation_id = $reserve->id;

            if(count($request->time)>0){
                foreach($request->time as $time){
                $reserve_time = new time_room_reserve();

                $reserve_time->reserve_room_id = $reservation_id;
                $reserve_time->time_reserve = $time;
                $reserve_time->date_reserve = lib::date_to_db($request->date);

                $reserve_time->save();
                }
            }

        return redirect()->route('reservation_details.index');   

    }
    
}
