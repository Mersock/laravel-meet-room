@extends('main')

@section('title','กำหนดห้องประชุม')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <h1 class="page-header">กำหนดช่วงเวลาในการจอง</h1>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
    
                                <div class="panel panel-default">
                                        <div class="panel-heading">
                                                <a href="#" id="search-toggle"><strong>เลือกช่วงเวลาในการจอง</strong></a>
                                        </div>
    
                                        {{Form::open(['id'=>'form-request','route'=>'set_time.update_time','method'=>'post','files'=>true])}} 
                                        <div class="panel-body">
                                            <div class="row text-center">
                                                  <div class="form-group col-lg-12">
                                                   {{Form::select('time[]',$timeArr,null,['class'=>'single-select-multiple validate-data',"multiple"=>"multiple","field"=>"เลือกช่วงเวลาในการจอง"])}}
                                                  </div>
                                            </div>
                                            <br>
                                            <div class="row text-center">
                                                    {{Form::button('เลือกทั้งหมด',['class'=>'btn btn-default btn-select-all','onclick'=>'select2_checkall()'])}}
                                                    {{Form::button('บันทึก',['class'=>'btn btn-success btn-save-req','onclick'=>'btn_save_req();'])}}
                                                    {{Form::button('ยกเลิก',['class'=>'btn btn-danger btn-reset-req','onclick'=>'btn_reset_req();'])}}                                
                                            </div>
                                        
                                        </div>      <!-- panel-body-->    
                                         {{ Form::close() }}
                                </div> <!-- panel-default -->

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
                                
                            <div class="table-responsive">  
                                <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>เวลา</th>
                                                @if(count($time_show)>0)
                                                    @foreach($time_show as $time)
                                                    <th>{{$time->time_hour}}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                </table>
                            </div>{{-- table-responsive --}}
                        </div> {{-- col-lg-12" --}}
                    </div>{{-- row --}}
                </div><!-- /.container-fluid -->
            </div><!-- /#page-wrapper -->
    @endsection

   