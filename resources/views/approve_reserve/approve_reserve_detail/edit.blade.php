@extends('main')

@section('content')

<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header"><a href="{{url('approve_reserve/approve_reserve_detail')}}">แก้ไขรายการจอง</a>&nbsp;&raquo;&nbsp;{{$reserv->title}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    @foreach($errors->all() as $error)
                   <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                        <div class="panel panel-default">

                                <div class="panel-heading">
                                <a href="#"><strong>{{$reserv->meet_room->name_room}}</strong></a>
                                </div>
                              
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>รหัสห้อง : {{$reserv->meet_room->code_room}}<p>  
                                            <p>ชื่อห้อง  : {{$reserv->meet_room->name_room}}</p>  
                                            <p>ประเภทห้อง : {{$reserv->meet_room->type_room->type_name}}</p>       
                                        </div>
                                        <div class="col-md-6">
                                          @if($reserv->meet_room->image_file!="" && file_exists('images/file_picture_room/'.$reserv->meet_room->image_file) )  
                                            <img src="{{asset('images/file_picture_room/'.$reserv->meet_room->image_file)}}"  alt="รูปภาพห้องประชุม" height="40%" width="90%">
                                          @else
                                            <img src="{{ asset('images/file_picture_room/no_Image.jpg') }}"  alt="รูปภาพห้องประชุม" height="40%" width="90%">
                                          @endif
                                        </div>
                                    </div>
                                </div>
                        </div><!-- /.panel panel-default -->
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                        <a href="#"><strong>รายละเอียดการขอใช้ห้องประชุม</strong></a>
                        </div>

                        <div class="panel-body">
                                {{Form::open(['id'=>'form-request','route'=>'approve_reserve_detail.update','method'=>'post','files'=>true])}}
                                {{Form::hidden('reserv_id',$reserv->id)}}
                            <div class="row">
                                <div class="col-md-2">
                                        {{Form::label('date','วันที่จอง :')}}
                                </div> 
                                <div class="col-md-6 form-group">
                                        {{Form::label('date',lib::date_from_db($reserv->reserve_date,'long') )}}                                                           
                                </div>                         
                            </div>

                            <div class="row">
                                    <div class="col-md-2">
                                            <span class="red-text">{{Form::label('time','เวลาที่จอง :')}}</span>
                                    </div>
                                    <div class="col-md-6 form-group">
                                            {{Form::select('time[]',$get_time_all,$get_time_use,['class'=>'single-select-multiple validate-data',"multiple"=>"multiple","field"=>"เลือกช่วงเวลาในการจอง",'onchage'=>'check_room();'])}}  
                                            {{Form::button('เลือกทั้งหมด',['class'=>'btn btn-default btn-select-all','onclick'=>'select2_checkall()','style'=>'margin-top:10px'])}}
                                           
                                    </div>
                                </div>    
                                                       
                            <div class="row">
                                <div class="col-md-2">
                                        <span class="red-text">{{Form::label('title','หัวข้อ :')}}</span>
                                </div>
                                <div class="col-md-6 form-group">
                                        {{Form::text('title',$reserv->title,['class'=>'form-control validate-data',"field"=>"หัวข้อ",'maxlength'=>'190'])}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                        {{Form::label('detail','รายละเอียดเพิ่มเติม :')}}
                                </div>
                                <div class="col-md-6 form-group">
                                        {{Form::textarea('detail',$reserv->detail,['class'=>'form-control','rows'=>'4','maxlength'=>'500'])}}
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-2">
                                            {{Form::label('detail','สถานะการจอง :')}}
                                    </div>
                                    <div class="col-md-6 form-group">
                                            จอง :{{Form::radio('status','0',true)}} &nbsp; ยกเลิก:{{Form::radio('status','3')}}
                                    </div>
                             </div>
                            <br>
                            <div class="row">
                                <div class="text-center">
                                        {{Form::button('บันทึก',['class'=>'btn btn-success btn-save-req','onclick'=>'btn_save_req();'])}}
                                        {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset-req','onclick'=>'btn_reset_req();'])}}
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                </div><!-- /.panel panel-default -->
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection

