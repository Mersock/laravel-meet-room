<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('patails._head')
@include('patails._script')
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h4>ลงทะเบียนผู้ใช้</h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('register') }} " role="form">
                            {{ csrf_field() }}
                            <div class="row">
                                    <label  class="col-md-3">รหัสบุคลากร :</label>
                                    <div class="col-md-8">
                                            <div class="form-group{{ $errors->has('code_user') ? ' has-error' : '' }}">
                                                <input id="code_user" type="text" class="form-control" name="code_user" value="{{ old('code_user') }}" maxlength="6" autofocus required onblur="check_dupicate(this.id,this.value,'/check_code_user')">
                                            </div>
    
                                        @if ($errors->has('code_user'))
                                            <span class="red-text">
                                                <strong>{{ $errors->first('code_user') }}</strong>
                                            </span>
                                        @endif   
    
                                    </div>
                                </div>

                            <div class="row">
                                <label  class="col-md-3">อีเมล :</label>
                                <div class="col-md-8">
                                        <div class="form-group input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required  onblur="check_dupicate(this.id,this.value,'/check_email_user')" ><span class="input-group-addon">@ppk.com</span>  
                                        </div>
                                    @if ($errors->has('email'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                            <div class="row">
                                <label  class="col-md-3">ชื่อ :</label>
                                <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                        </div>

                                    @if ($errors->has('name'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif   

                                </div>
                            </div>

                            <div class="row">
                                    <label  class="col-md-3">นามสกุล :</label>
                                    <div class="col-md-8">
                                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                            </div>
    
                                        @if ($errors->has('last_name'))
                                            <span class="red-text">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif   
    
                                    </div>
                                </div>                            
    
                        <div class="row">
                                <label  class="col-md-3">รหัสผ่าน :</label>
                                <div class="col-md-8">
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control" name="password" minlength="6" required>
                                        </div>
    
                                        @if ($errors->has('password'))
                                            <span class="red-text">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                         @endif
                                </div>
                        </div>

                        <div class="row">
                                <label  class="col-md-3">ยืนยันรหัสผ่าน :</label>
                                <div class="col-md-8">
                                        <div class="form-group">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="6" required>
                                        </div>

                                </div>
                        </div>
                        {{-- <div class="row">
                                <label class="col-md-3">สิทธิ์การใช้งาน :</label>
                                <div class="col-md-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="user_status" id="user_status_1" value="member" checked>ผู้ใช้งานทั่วไป
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="user_status" id="user_status_2" value="admin">ผู้ดูแลระบบ
                                    </label>
                                </div>
                            </div>                         --}}
                        <br>
                        <button type="submit" class="btn btn-lg btn-success btn-block">
                                ลงทะเบียน
                        </button>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>