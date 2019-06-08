<?php

namespace App\Http\Controllers\set_meet_room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//modal
use App\model\set_meet_room\set_time;

//lib
use App\Helpers\lib;

class Set_Time_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(){
        $timeArr = array(
            "00:00"=>"00:00",
            "01:00"=>"01:00",
            "02:00"=>"02:00",
            "03:00"=>"03:00",
            "04:00"=>"04:00",
            "05:00"=>"05:00",
            "06:00"=>"06:00",
            "07:00"=>"07:00",
            "08:00"=>"08:00",
            "09:00"=>"09:00",
            "10:00"=>"10:00",
            "11:00"=>"11:00", 
            "12:00"=>"12:00",
            "13:00"=>"13:00",
            "14:00"=>"14:00",
            "15:00"=>"15:00",
            "16:00"=>"16:00",
            "17:00"=>"17:00",
            "18:00"=>"18:00",
            "19:00"=>"19:00",
            "20:00"=>"20:00",
            "21:00"=>"21:00",
            "22:00"=>"22:00",
            "23:00"=>"23:00",
        );
    
        $time_show = set_time::Get_Time()->get();

        return view('set_meet_room.set_time.index',compact(['timeArr','time_show']) );
    }

    public function update_time(Request $request){
        if($request->time){

            set_time::truncate();  

            foreach($request->time as $time){
                $set_time = new set_time();

                $set_time->time_hour = $time;
                $set_time->created_by = lib::GetUser();
                $set_time->updated_by = lib::GetUser();

                $set_time->save();
            }

        }
        return redirect()->route('set_time.index');
    }


}
