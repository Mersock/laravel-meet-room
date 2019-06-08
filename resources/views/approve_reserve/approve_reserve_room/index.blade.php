@extends('main')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">อนุมัติการจอง</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#" id="search-toggle"><strong>ส่วนของการค้นหา</strong></a>
                                </div>
                                <!-- /.panel-heading -->
                                 <div class="panel-body" id="search-area" >
                                    {{ Form::open(['method'=>'get','id'=>'form-search']) }}
                                        <div class="row">
                                            <div class="col-md-2">
                                                    {{Form::label('room','ห้อง :')}}
                                            </div> 
                                            <div class="col-md-3">
                                                    {{ Form::select('room',$room,null,['class'=>'form-control single-select','placeholder'=>'กรุณาเลือก']) }}
                                            </div>
                                            <div class="col-md-2 col-md-offset-1">
                                                    {{Form::label('reserve_date','วันที่จอง :')}}
                                            </div>
                                            <div class="col-md-3">
                                                    {{ Form::text('reserve_date',null,['class'=>'form-control datepicker']) }}
                                            </div>
                                        </div>
                                        <br>
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
                             
                            <!-- /.panel -->
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                    <tr>
                                                        <th width="5%" class="text-center">ลำดับที่</th>
                                                        <th width="10%" class="text-center">ชื่อห้อง</th>
                                                        <th width="15%" class="text-center">รายละเอียด</th>
                                                        <th width="20%" class="text-center">หัวข้อ</th>
                                                        <th width="10%" class="text-center">วันที่จอง</th>
                                                        <th width="15%" class="text-center">เวลาที่จอง</th>
                                                        <th width="15%" class="text-center">ผู้จอง</th>
                                                        <th width="5%" class="text-center">จัดการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            @if(count($reserive_detail)>0)
                                                @foreach($reserive_detail as $key =>  $detail)
                                                    <tr>
                                                        <td align="center">{{$key+1}}</td>
                                                        <td>{{$detail->meet_room->name_room}}</td>
                                                        <td>{{$detail->title}}</td>
                                                        <td>{{$detail->detail}}</td>
                                                        <td>{{lib::date_from_db($detail->reserve_date,'short')}}</td>
                                                        <td>
                                                        @if(isset($get_time_reserv[$detail->id]))
                                                            {{min($get_time_reserv[$detail->id])." - ".max($get_time_reserv[$detail->id])}} 
                                                        @endif
                                                        </td>
                                                        <td>{{$detail->user->name." ".$detail->user->last_name}}</td>
                                                        <td>{!! lib::edit_data(".approve-data-$detail->id") !!}</td>
                                                    </tr>
                                                    @include('approve_reserve.approve_reserve_room.approve')
                                                @endforeach
                                            @else
                                                    <tr>
                                                        <td colspan="8" class="text-center"><span class="red-text">ไม่มีข้อมูล</span></td>
                                                    </tr>
                                            @endif
                                                </tbody>
                                    </table>
                                </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

