@extends('main')

@section('stylesheet')
<link href="{{ asset('css/table_room.css') }}" rel="stylesheet">
@endsection

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">รายการจองห้องประชุม</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">

                            <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <a href="#" id="search-toggle"><strong>จองห้องประชุม</strong></a>
                                    </div>

                                    <div class="panel-body" id="search-area" >
                                            {{ Form::open(['method'=>'get','id'=>'form-search']) }}
                                                <div class="row">
                                                        <div class="col-md-2 ">
                                                                {{Form::label('s_date','วันที่จอง :')}}
                                                        </div> 
                                                        <div class="col-md-3">
                                                                {{Form::text('s_date',$date_show,['class'=>'form-control datepicker','onchange'=>'date_choose(this.value)']) }}                                                              
                                                        </div>                                                         
                                                        <div class="col-md-2 col-md-offset-1">
                                                                {{Form::label('s_room','ชื่อห้อง :')}}
                                                        </div> 
                                                        <div class="col-md-3">
                                                                {{ Form::text('s_room',null,['class'=>'form-control']) }}
                                                        </div>                                                     
                                                </div>                                            
                                                <br>
                                                <div class="row">
                                                    <div class="text-center">
                                                            {{Form::button('ค้นหา',['class'=>'btn btn-info btn-search','id'=>'btn-search'])}}&nbsp;&nbsp;
                                                            {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset','id'=>'btn-reset'])}}
                                                    </div>
                                                </div>
                                        </div><!-- /.panel-body -->
                                             {{ Form::close() }}
                            </div> <!-- panel-default -->

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                    <tr>
                                        <td width="25%"><strong> รายการจองวันที่ {{lib::date_to_input($date_show,'long')}}</strong></td>
                                        <td width="25%"><strong> ว่าง </strong></td>
                                        <td width="25%" class="room_reserve"><strong> จองแล้ว </strong></td>
                                        <td width="25%" class="room_approve"><strong> อนุมัติแล้ว </strong></td>
                                    </tr>
                            </table>
                        </div>
                        
                        <div class="table-responsive">  
                            <table class="table table-bordered table-hover table-striped">
                                    <tr>
                                        <td class="room">ห้องประชุม</td>
                                        {{-- เวลา --}}
                                    @if(count($timeArr)>0)  
                                        @foreach($timeArr as $time)
                                        <td align="center">{{$time}}</td>
                                        @endforeach  {{--  timeArr --}}
                                    @endif {{--count($timeArr) --}}
                                    </tr>
                                    {{-- ห้องประชุม --}}
                                    @if(count($rooms)>0) 
                                        @foreach($rooms as $room)                                   
                                    <tr>
                                        <td class="room">
                                            {{Form::open(['id'=>'reserve_'.$room->id,'method'=>'get','route'=>['reservation_details.reserve',$room->id]])}}
                                            {{Form::hidden('date_reserve',null)}}
                                                    
                                                  @if(strtotime($compare_date) >= strtotime(date('Y/m/d')) )
                                                    <a class="get_reserve" style="cursor: pointer;" onclick="submit_room({{$room->id}})"> {{$room->name_room}} </a>
                                                  @else
                                                    <span style="cursor: pointer;"> {{$room->name_room}} </span>
                                                  @endif
                                            {{Form::close()}}
                                        </td>
                                        @if(count($timeArr)>0)
                                            @foreach($timeArr as $time)
                                                    {{-- ช่วงเวลาที่จองและที่ว่าง --}}
                                                @if( isset($get_reseve[$room->id]['time'][$time]) )
                                                    <td class="{{($get_reseve[$room->id]['approve'][$time]==1)?"room_approve":"room_reserve"}}"><span class="title_reserve" title="" data-html="true" data-original-title="{{ isset($get_reseve[$room->id]['title'][$time])?'หัวข้อ : '.$get_reseve[$room->id]['title'][$time].'<br>':"" }} {{ isset($get_reseve[$room->id]['detail'][$time])?'รายละเอียด : '.$get_reseve[$room->id]['detail'][$time]:"" }}" ></span></td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endforeach  {{--  timeArr --}}
                                        @endif
                                    </tr>
                                        @endforeach {{-- rooms --}}
                                    @else
                                    <tr>
                                        <td colspan="{{count($timeArr)+1}}" class="red-text text-center">ไม่มีข้อมูล</td>
                                    </tr>
                                    @endif {{-- rooms --}}
                            </table>

                        </div>{{-- table-responsive --}}
                    </div> {{-- col-lg-5" --}}
                </div>{{-- row --}}
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
 $(document).ready(function(){

    $(".title_reserve").tooltip({
    placement: "top"
    });
    $(".title_reserve").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');



 });

 function date_choose(val){
     $("input[name='date_reserve']").val(val);
 }
 function submit_room(id){

        $('#reserve_'+id).submit();
  }
    </script>
@endsection