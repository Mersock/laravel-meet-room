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
                        <h4>รีเซ็ตรหัสผ่าน</h4>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="row">
                                <label  class="col-md-3">อีเมล :</label>
                                <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        </div>

                                    @if ($errors->has('email'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">
                                ยืนยันการรีเซ็ต
                        </button>
                    </div>
       
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>
