<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('template.sb_admin_2._head')
    <body>
    <div id="wrapper">
@include('template.sb_admin_2._nav')
    @yield('content')

    </div>
@include('template.sb_admin_2._script')  
    </body>
</html>
