                <div class="modal fade add-data"   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h2 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h2>
                            </div>
                            <div class="modal-body">
                                {{Form::open(['id'=>'form-request','route'=>'set_room.store','method'=>'post','files'=>true])}} 
                                    <div class="row">
                                        <div class="form-group col-md-6 col-md-offset-3">
                                        <span class="red-text">{{Form::label('code_room','รหัสห้อง :')}}</span>
                                        {{Form::text('code_room',null,['onblur'=>'check_dupicate(this.id,this.value,"/check_code_room")','class'=>'form-control validate-data','field'=>'รหัสห้อง','maxlength'=>'191'])}}
                                        
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="form-group col-md-6 col-md-offset-3">
                                            <span class="red-text">{{Form::label('name_room','ชื่อห้อง :')}}</span>
                                            {{Form::text('name_room',null,['class'=>'form-control validate-data','field'=>'ชื่อห้อง','maxlength'=>'191'])}}
                                            </div>
                                            
                                    </div>
                                    <div class="row">
                                            <div class="form-group col-md-6 col-md-offset-3">
                                            <span class="red-text">{{Form::label('room_type','ประเภทห้อง :')}}</span><br>
                                            {{Form::select('room_type',$type_room,null,['class'=>'add-single-select validate-data','placeholder' => '','field'=>'ประเภทห้อง'])}}
                                            </div> 
                                            
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            {{Form::label('image_room','รูปภาพ :')}}
                                            {{Form::file('image_room')}}
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
