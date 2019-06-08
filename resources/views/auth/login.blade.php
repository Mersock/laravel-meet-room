<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('patails._head')
@include('patails._script')
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">เข้าสู่ระบบ</h3>
                    </div>
                    <div class="panel-body">
                        <form  method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input id="email" type="email" placeholder="อีเมล" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                   
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="รหัสผ่าน" class="form-control" name="password" required>


                                @if ($errors->has('password'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                                
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> จดจำชื่อผู้ใช้
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">
                                    เข้าสู่ระบบ
                                </button><br>
                                <a href="{{ route('password.request') }}">
                                    ลืมรหัสผ่าน?
                                </a>
                                &nbsp;&nbsp;
                                <a href="{{ route('register') }}">
                                    ลงทะเบียน
                                </a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>
