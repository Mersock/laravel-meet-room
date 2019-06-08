{{Form::open(['id'=>'form-del_'.$type->id,'route'=>['set_type_room.destroy',$type->id],'method'=>'DELETE'])}}

{{ Form::close()}}