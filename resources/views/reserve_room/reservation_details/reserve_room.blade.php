@extends('main')

@section('content')

<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header"><a href="{{url('reserve_room/reservation_details')}}">รายการจองห้องประชุม</a>&nbsp;&raquo;&nbsp;{{$room->name_room}}</h1>
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
                                <a href="#"><strong>{{$room->name_room}}</strong></a>
                                </div>
                              
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>รหัสห้อง : {{$room->code_room}}<p>  
                                            <p>ชื่อห้อง  : {{$room->name_room}}</p>  
                                            <p>ประเภทห้อง : {{$room->type_room->type_name}}</p>       
                                        </div>
                                        <div class="col-md-6">
                                          @if($room->image_file!="" && file_exists('images/file_picture_room/'.$room->image_file) )  
                                            <img src="{{asset('images/file_picture_room/'.$room->image_file)}}"  alt="รูปภาพห้องประชุม" height="40%" width="90%">
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
                                {{Form::open(['id'=>'form-request','route'=>'reservation_details.reserve_create','method'=>'post','files'=>true])}}
                                {{Form::hidden('room_id',$room->id)}}
                            <div class="row">
                                <div class="col-md-2">
                                        {{Form::label('date','วันที่จอง :')}}
                                </div> 
                                <div class="col-md-6 form-group">
                                        {{Form::label('date',lib::date_to_input($date_req,'long') )}}
                                        {{Form::hidden('date',$date_req) }}                                                              
                                </div>                                     
                            </div>
                            <div class="row">
                                    <div class="col-md-2">
                                            <span class="red-text">{{Form::label('time','เวลาที่จอง :')}}</span>
                                    </div>
                                    <div class="col-md-6 form-group">
                                            {{Form::select('time[]',$timeArr,null,['class'=>'single-select-multiple validate-data',"multiple"=>"multiple","field"=>"เลือกช่วงเวลาในการจอง",'onchage'=>'check_room();'])}}  
                                            {{Form::button('เลือกทั้งหมด',['class'=>'btn btn-default btn-select-all','onclick'=>'select2_checkall()','style'=>'margin-top:10px'])}}
                                           
                                    </div>
                                </div>                            
                            <div class="row">
                                <div class="col-md-2">
                                        <span class="red-text">{{Form::label('title','หัวข้อ :')}}</span>
                                </div>
                                <div class="col-md-6 form-group">
                                        {{Form::text('title',null,['class'=>'form-control validate-data',"field"=>"หัวข้อ",'maxlength'=>'190'])}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                        {{Form::label('detail','รายละเอียดเพิ่มเติม :')}}
                                </div>
                                <div class="col-md-6 form-group">
                                        {{Form::textarea('detail',null,['class'=>'form-control','rows'=>'4','maxlength'=>'500'])}}
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

