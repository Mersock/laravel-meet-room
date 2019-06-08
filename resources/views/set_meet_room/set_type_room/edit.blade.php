<div class="modal fade edit-data-{{$type->id}}"   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h2>
                </div>
                <div class="modal-body">
                    {{Form::open(['id'=>'form-update_'.$type->id,'route'=>['set_type_room.update',$type->id],'method'=>'PUT','files'=>true])}}

                    <div class="row">
                        <div class="form-group col-md-6 col-md-offset-3">
                                <strong><span>รหัสประเภทห้อง : </span></strong>{{$type->code_type}}
                        </div>
                    </div>

                        <div class="row">
                                <div class="form-group col-md-6 col-md-offset-3">
                                <span class="red-text">{{Form::label('code_room','ชื่อประเภทห้อง :')}}</span>
                                {{Form::text('edit_type_name',$type->type_name,['id'=>'type_name_'.$type->id,'class'=>'form-control validate-data_'.$type->id,'field'=>'รหัสประเภทห้อง','maxlength'=>'191'])}}
                                </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                {{Form::label('active','สถานะการใช้งาน :')}}<br>
                                ใช้งาน :{{Form::radio('edit_active','1',($type->active==1)?true:"")}} &nbsp; ไม่ใช้งาน:{{Form::radio('edit_active','0',($type->active==0)?true:"")}}
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                                {{Form::button('บันทึก',['class'=>'btn btn-success btn-save-req','onclick'=>'btn_save_update('.$type->id.');'])}}
                                {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset-req','onclick'=>'btn_reset_update();'])}}
                </div>
                {{Form::close()}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
