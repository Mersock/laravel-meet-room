@extends('main')

@section('title','กำหนดประเภทห้องประชุม')


@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">กำหนดประเภทห้องประชุม</h1>
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

                                                <div class="panel-body" id="search-area" style="display:none;">
                                                        {{ Form::open(['method'=>'get','id'=>'form-search']) }}
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                        {{Form::label('s_code_type','รหัสประเภทห้อง :')}}
                                                                </div> 
                                                                <div class="col-md-3">
                                                                        {{ Form::text('s_code_type',null,['class'=>'form-control']) }}
                                                                </div>
                                                                <div class="col-md-2 col-md-offset-1">
                                                                        {{Form::label('s_type_name','ชื่อประเภทห้อง :')}}
                                                                </div> 
                                                                <div class="col-md-3">
                                                                        {{ Form::text('s_type_name',null,['class'=>'form-control']) }}
                                                                </div>                                                                
                                                             </div>
                                                             <br>
                                                             <div class="row">
                                                                <div class="col-md-2">
                                                                        {{Form::label('s_active','สถานะการใช้งาน :')}}
                                                                </div>
                                                                <div class="col-md-3">
                                                                        {{Form::select('s_active',$active,null,['class'=>'single-select','placeholder' => ''])}}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="text-center">
                                                                        {{Form::button('ค้นหา',['class'=>'btn btn-info btn-search','id'=>'btn-search'])}}&nbsp;&nbsp;
                                                                        {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset','id'=>'btn-reset'])}}
                                                                </div>
                                                            </div>
                                                    </div><!-- /.panel-body -->
                                                         {{ Form::close() }}
                                        </div> <!-- panel-default -->
                           
                                        <div class="row">
                                                        <div class="col-md-1">
                                                           <button class="btn btn-primary btn-add" data-toggle="modal" data-target=".add-data">เพิ่มข้อมูล</button>
                                                           @include('set_meet_room.set_type_room.create')
                                                           
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
                                                                <th width="20%" class="text-center">รหัสประเภทห้อง</th>
                                                                <th width="30%" class="text-center">ชื่อประเภทห้อง</th>
                                                                <th width="20%" class="text-center">สถานะการใช้งาน</th>
                                                                <th width="20%" class="text-center">จัดการ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                        @if(count($type_room)>0)
                                                @foreach($type_room as $key_type => $type)
                                                                <tr>
                                                                        <td align="center">{{$type_room->firstItem()+$key_type}}</td>
                                                                        <td>{{$type->code_type}}</td>
                                                                        <td>{{$type->type_name}}</td>
                                                                        <td>{{lib::active_status($type->active)}}</td>
                                                                        <td align="center"> 
                                                                                {!! lib::edit_data(".edit-data-$type->id") !!}&nbsp;
                                                                                @if(lib::check_relate($type->id,'pk_meet_room','type_id')==0)
                                                                                        {!! lib::delete_data($type->id) !!}
                                                                                @else
                                                                                        {!! lib::delete_data_dis() !!}
                                                                                @endif
                                                                        </td>
                                                                </tr>
                                                                @if(lib::check_relate($type->id,'pk_meet_room','type_id')==0)
                                                                        @include('set_meet_room.set_type_room.delete')
                                                                @endif
                                                                
                                                                @include('set_meet_room.set_type_room.edit')
                                                @endforeach
                                        @else
                                                <tr>
                                                <td colspan="5" class="text-center red-text">ไม่พบข้อมูล</td>  
                                                </tr>
                                         @endif                                        
                                                        </tbody>
                                        </table>                                       
                                        {!! lib::pagination($type_room->total(),$type_room->links()) !!}
                                </div><!-- col-lg-12 -->
                    </div><!-- /.row -->
                </div>
                <!-- /.container-fluid -->
    </div>
            <!-- /#page-wrapper -->     
@endsection
