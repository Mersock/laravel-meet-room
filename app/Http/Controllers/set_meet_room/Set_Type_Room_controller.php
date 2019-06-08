<?php

namespace App\Http\Controllers\set_meet_room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//modal
use App\model\set_meet_room\type_room;

//lib
use App\Helpers\lib;

class Set_Type_Room_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cond = [];
        $type_room = [];
        $type_name = [];
        $code_type = [];
        $s_active = [];
        
        
        if($request->s_code_type){
            $code_type =  [['code_type','=',$request->s_code_type]]; 
          }
        if($request->s_type_name){
            $type_name =  [['type_name','like',"%".$request->s_type_name."%"]]; 
          }
        if($request->s_active){
            $s_active =   [['active','=',$request->s_active]]; 
        }
        $cond =     array_merge($type_name,$s_active,$code_type);
        $rows =      type_room::Gettype_room()->where($cond)->count();
        $type_room = type_room::Gettype_room()
                            ->where($cond)
                            ->paginate(5);
        $active = ['1' => 'ใช้งาน','2' => 'ไม่ใช้งาน'];

        return view('set_meet_room.set_type_room.index',compact(['active','type_room']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'code_type'  => 'required|max:190|unique:pk_type_room',
            'type_name' =>  'required|max:190',
            'active' => 'required'
         ]);

           $type_room = new type_room();

           $type_room->code_type = $request->code_type;
           $type_room->type_name = $request->type_name;
           $type_room->active    = $request->active;
           $type_room->created_by =  lib::GetUser();
           $type_room->save();

           return redirect()->route('set_type_room.index');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $request->validate([
                'edit_type_name' =>  'required|max:190',
                'edit_active' => 'required'
             ]);    

             $type_room = type_room::find($id);
             $type_room->type_name = $request->edit_type_name;
             $type_room->active    = $request->edit_active;
             $type_room->updated_by =  lib::GetUser();

             $type_room->save();

             return redirect()->route('set_type_room.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $type_room = type_room::find($id);
            $type_room->delete();
            
            return redirect()->route('set_type_room.index');

    }
}
