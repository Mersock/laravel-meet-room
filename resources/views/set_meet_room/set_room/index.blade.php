@extends('main')

@section('title','กำหนดห้องประชุม')


@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">กำหนดห้องประชุม</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                    <div class="col-lg-12">
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="#" id="search-toggle"><strong>ส่วนของการค้นหา</strong></a>
                            </div>
                            <!-- /.panel-heading -->
                             <div class="panel-body" id="search-area" style="display:none;">
                                {{ Form::open(['method'=>'get','id'=>'form-search']) }}
                                    <div class="row">
                                        <div class="col-md-2">
                                                {{Form::label('s_code_room','รหัสห้อง :')}}
                                        </div> 
                                        <div class="col-md-3">
                                                {{ Form::text('s_code_room',null,['class'=>'form-control']) }}
                                        </div>
                                        <div class="col-md-2 col-md-offset-1">
                                                {{Form::label('s_name_room','ชื่อห้อง :')}}
                                        </div>
                                        <div class="col-md-3">
                                                {{ Form::text('s_name_room',null,['class'=>'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-center">
                                                {{Form::button('ค้นหา',['class'=>'btn btn-info btn-search','id'=>'btn-search'])}}&nbsp;&nbsp;
                                                {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset','id'=>'btn-reset'])}}
                                        </div>
                                    </div>
                            </div>
                               <!-- /.panel-body -->
                                 {{ Form::close() }}
                         </div>
                        
                         <div class="row">
                             <div class="col-md-1">
                                <button class="btn btn-primary btn-add" data-toggle="modal" data-target=".add-data">เพิ่มข้อมูล</button>
                                @include('set_meet_room.set_room.create')
                                
                             </div>
                         </div>
                         <br>
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
                         <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%" class="text-center">ลำดับที่</th>
                                        <th width="15%" class="text-center">รหัสห้อง</th>
                                        <th width="20%" class="text-center">ชื่อห้อง</th>
                                        <th width="20%" class="text-center">ประเภทห้อง</th>
                                        <th width="20%" class="text-center">รูปภาพ</th>
                                        <th width="10%" class="text-center">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @if(count($Rooms)>0)
                                @foreach($Rooms as $key_room => $room)
                                        <tr>
                                            <td align="center">{{$Rooms->firstItem()+$key_room}}</td>
                                            <td>{{ $room->code_room }}</td>
                                            <td>{{ $room->name_room }}</td>
                                            <td>{{ $room->type_room->type_name}}</td>
                                            <td align="center">
                                                @if($room->image_file!="")
                                                <img src="{{asset('images/file_picture_room/'.$room->image_file )}}" class="img-rounded" width="50px" height="50px">
                                                @endif
                                            </td>
                                            <td align="center">
                                                {!! lib::edit_data(".edit-data-$room->id") !!}&nbsp;
                                                @if(lib::check_relate($room->id,'pk_reserve_room','room_id')==0)
                                                    {!! lib::delete_data($room->id) !!}
                                                @else
                                                    {!! lib::delete_data_dis() !!}
                                                @endif
                                            </td>
                                        </tr>
                                        @if(lib::check_relate($room->id,'pk_reserve_room','room_id')==0)
                                                @include('set_meet_room.set_room.delete')
                                        @endif                                        
                                        @include('set_meet_room.set_room.edit')
                                @endforeach
                            @else
                                        <tr>
                                            <td colspan="6" class="text-center red-text">ไม่พบข้อมูล</td>  
                                        </tr>
                            @endif
                                </tbody>
                            </table>
                             <!-- /.table-responsive -->
                     </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    {!! lib::pagination($Rooms->total(),$Rooms->links()) !!}
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->     
@endsection
