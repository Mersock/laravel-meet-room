<?php

namespace App\Http\Controllers\set_meet_room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//model
use App\model\set_meet_room\meet_room;
use App\model\set_meet_room\type_room;

//lib
use App\Helpers\lib;


//image
use Image;
use Storage;
use File;

class Set_Room_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {   
        $cond = [];
        $Rooms = [];
        $code_room =[];
        $name_room = [];
        $type_room = [];

        if($request->s_code_room){
          $code_room =  [['code_room','=',$request->s_code_room]]; 
        }
        if($request->s_name_room){
          $name_room =   [['name_room','like',"%".$request->s_name_room."%"]]; 
         }
         
        $cond =  array_merge($code_room,$name_room);
        $rows = meet_room::GetMeet_room()->where($cond)->count();
        $Rooms = meet_room::GetMeet_room()
                        ->where($cond)  
                        ->paginate(5);
       
        $type_room = type_room::Type_Room_active()->pluck('type_name','id');


        return view('set_meet_room.set_room.index',compact(['Rooms','type_room']) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $request->validate([
               'code_room'  => 'required|max:190|unique:pk_meet_room',
               'name_room' =>  'required|max:190',
               'room_type' =>  'required',
               'image_room' => 'image|mimes:jpeg,png,bmp',
               'active' => 'required'
            ]);
            $image = lib::upload_file($request->file('image_room'),'/images/file_picture_room/');
            
            $meet_room = new meet_room();
            
            $meet_room->code_room = $request->code_room;
            $meet_room->name_room = $request->name_room;
            $meet_room->type_id = $request->room_type;
            $meet_room->active = $request->active;
            $meet_room->image_room = ($image['image_name']=="")?null:$image['image_name'];
            $meet_room->image_file = ($image['file_name']=="")?null:$image['file_name'];
            $meet_room->created_by = lib::GetUser();
            $meet_room->save();

            return redirect()->route('set_room.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            // dd($request);
            $request->validate([
                'edit_name_room' =>  'required|max:190',
                'edit_room_type' =>  'required',
                'edit_image_room' => 'image|mimes:jpeg,png,bmp',
                'active' => 'required'
             ]);
            
            $meet_room = meet_room::find($id);
            $old = $meet_room->image_file;
           
            $meet_room->name_room = $request->input('edit_name_room');
            $meet_room->type_id = $request->input('edit_room_type');
            $meet_room->active =  $request->input('active');
            $meet_room->update_by = lib::GetUser();
            
            if($request->file('edit_image_room')){
                lib::delete_file('/images/file_picture_room/'.$meet_room->image_file);
                $image = lib::upload_file($request->file('edit_image_room'),'/images/file_picture_room/');
                $meet_room->image_room = ($image['image_name']=="")?null:$image['image_name'];
                $meet_room->image_file = ($image['file_name']=="")?null:$image['file_name'];
            }

            $meet_room->save();

            return redirect()->route('set_room.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

           $meet_room = meet_room::find($id);
           $path = "/images/file_picture_room/";
           if($meet_room->image_file){
               lib::delete_file($path.$meet_room->image_file);
                $meet_room->image_room = null;
                $meet_room->image_file = null;
           }
           $meet_room->delete();
           return redirect()->route('set_room.index');

    }


}
