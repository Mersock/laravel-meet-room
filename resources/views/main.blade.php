<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('patails._head')
@include('patails._script')  
    <body>
    <div id="wrapper">
@include('patails._nav')
    @yield('content')

    </div>
@include('patails._foot') 
</body>
</html>
