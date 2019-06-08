<div class="modal fade add-data"   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h2>
                </div>
                <div class="modal-body">
                    {{Form::open(['id'=>'form-request','route'=>'set_type_room.store','method'=>'post','files'=>true])}} 

                        <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                            <span class="red-text">{{Form::label('code_room','รหัสประเภทห้อง :')}}</span>
                            {{Form::text('code_type',null,['id'=>'code_type','onblur'=>'check_dupicate(this.id,this.value,"/check_type_room")','class'=>'form-control validate-data','field'=>'รหัสประเภทห้อง','maxlength'=>'191'])}}
                            </div>
                        </div>

                        <div class="row">
                                <div class="form-group col-md-6 col-md-offset-3">
                                <span class="red-text">{{Form::label('code_room','ชื่อประเภทห้อง :')}}</span>
                                {{Form::text('type_name',null,['id'=>'type_name','class'=>'form-control validate-data','field'=>'รหัสประเภทห้อง','maxlength'=>'191'])}}
                                </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                {{Form::label('active','สถานะการใช้งาน :')}}<br>
                                ใช้งาน :{{Form::radio('active','1',true)}} &nbsp; ไม่ใช้งาน:{{Form::radio('active','0')}}
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                                {{Form::button('บันทึก',['class'=>'btn btn-success btn-save-req','onclick'=>'btn_save_req();'])}}
                                {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset-req','onclick'=>'btn_reset_req();'])}}
                </div>
                {{Form::close()}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
