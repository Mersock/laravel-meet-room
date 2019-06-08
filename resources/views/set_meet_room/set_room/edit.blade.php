<div class="modal fade edit-data-{{$room->id}}"   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h2>
            </div>
            <div class="modal-body">
                {{Form::open(['id'=>'form-update_'.$room->id,'route'=>['set_room.update',$room->id],'method'=>'PUT','files'=>true])}} 
                    <div class="row">
                        <div class="form-group col-md-6 col-md-offset-3">
                        <strong><span>รหัสห้อง : </span></strong>{{$room->code_room}}
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                            <span class="red-text">{{Form::label('edit_name_room','ชื่อห้อง :')}}</span>
                            {{Form::text('edit_name_room',$room->name_room,['id'=>'edit_name_room_'.$room->id,'class'=>'form-control validate-data_'.$room->id,'field'=>'ชื่อห้อง','maxlength'=>'191'])}}
                            </div>
                            
                    </div>
                    <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                            <span class="red-text">{{Form::label('edit_room_type','ประเภทห้อง :')}}</span><br>
                            {{Form::select('edit_room_type',$type_room,$room->type_id,['id'=>'edit_room_type_'.$room->id,'class'=>'single-select validate-data_'.$room->id,'placeholder' => '','field'=>'ประเภทห้อง'])}}
                            </div> 
                            
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-md-offset-3">
                            {{Form::label('edit_image_room','รูปภาพ :')}}
                            {{Form::file('edit_image_room',['id'=>'edit_image_room_'.$room->id])}}
                        </div>
                    </div>
                    
                    <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                {{Form::label('active','สถานะการใช้งาน :')}}<br>
                                ใช้งาน :&nbsp;{{Form::radio('active','1',($room->active=='1')?true:"")}} &nbsp; ไม่ใช้งาน :&nbsp;{{Form::radio('active','0',($room->active=='0')?true:"")}}
                            </div>
                        </div>                
            </div>
            <div class="modal-footer">
                            {{Form::button('บันทึก',['class'=>'btn btn-success btn-save-update','onclick'=>'btn_save_update('.$room->id.')'])}}
                            {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset-update','onclick'=>'btn_reset_update()'])}}
            </div>
            {{Form::close()}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
