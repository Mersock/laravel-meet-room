        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                          
                {{-- <a  class="navbar-brand" href="{{url('/')}}"><img class="img-circle" src="{{ asset('images/logo_ppk/1056320291.png') }}" height="50px"></a> --}}
                <a  class="navbar-brand" href="{{url('/')}}"><img class="img-circle" src="{{ asset('images/logo_ppk/meet.jpg') }}" height="50px"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                @guest
                <li><a href="{{ route('login') }}"><span class="glyphicon-log-in"></span>Login</a></li>
                <li><a href="{{ route('register') }}"><span class="glyphicon-registration-mark"></span>Register</a></li>                
                @else
                <li><a href="#"><i class="fa fa-user fa-fw"></i> <strong>รหัสบุคลากร : </strong> {{Auth::user()->code_user}}  <strong>ชื่อ-สกุล : </strong>{{Auth::user()->name." ".Auth::user()->last_name}}</a>
                    <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                         <span class="glyphicon glyphicon-log-out"></span>  Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>                    
                @endguest
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" style="margin-top:60px;">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        @if(Auth::user()->user_status == 'admin')    
                        <li>
                            <a href="#"><span class="fa arrow"></span><i class="fa fa-database"></i>&nbsp;ฐานข้อมูลระบบงานจองห้องประชุม&nbsp;</a>
                            <ul class="nav nav-second-level">
                                <li>                                   
                                    <a href="{{route('set_type_room.index')}}">กำหนดประเภทห้องประชุม</a>
                                </li>
                                <li>
                                    <a href="{{route('set_room.index')}}">กำหนดห้องประชุม</a>
                                </li>
                                <li>
                                    <a href="{{route('set_time.index')}}">กำหนดช่วงเวลาในการจอง</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>  
                        @endif   
                        <li>
                            <a href="#"><span class="fa arrow"></span><i class="fa fa-edit"></i>&nbsp;จองห้องประชุม&nbsp;</a> 
                            <ul class="nav nav-second-level">
                                @if(Auth::user()->user_status == 'admin') 
                                    <li>
                                        <a href="{{route('approve_reserve_room.index')}}">อนุมัติการจอง</a>
                                    </li>
                                @endif
                                    <li>
                                        <a href="{{route('reservation_details.index')}}">รายการจองห้องประชุม</a>
                                     </li>
                                     <li>
                                        <a href="{{route('approve_reserve_detail.index')}}">แก้ไข/ยกเลิกการจองห้องประชุม</a>
                                     </li>                               
                            </ul>
                        </li>                 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>