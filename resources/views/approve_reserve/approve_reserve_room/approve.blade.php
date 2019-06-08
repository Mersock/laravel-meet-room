<div class="modal fade approve-data-{{$detail->id}}"   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title" id="myModalLabel">อนุมัติการจอง {{$detail->meet_room->name_room}}</h2>
                </div>
                <div class="modal-body">
                        {{Form::open(['id'=>'form-update_'.$detail->id,'route'=>['approve_reserve_room.approve',$detail->id],'method'=>'POST','files'=>true])}}
                        {{Form::hidden('reserve',$detail->id)}}  
                        <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3">
                                {{Form::label('approve_status','สถานะการอนุมัติ :')}}<br>
                                อนุมัติ :{{Form::radio('approve_status','1',true)}} &nbsp; ไม่อนุมัติ:{{Form::radio('approve_status','2')}}
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                        {{Form::button('บันทึก',['class'=>'btn btn-success btn-save-update','onclick'=>'btn_save_update('.$detail->id.')'])}}
                        {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset-update','onclick'=>'btn_reset_update()'])}}
                </div>
                {{Form::close()}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->