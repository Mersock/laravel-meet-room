{{Form::open(['id'=>'form-del_'.$room->id,'route'=>['set_room.destroy',$room->id],'method'=>'DELETE'])}}

{{ Form::close()}}