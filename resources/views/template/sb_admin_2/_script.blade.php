    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('extension/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('extension/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/sb-admin-2.js')}}"></script> 

    <!-- select 2 -->
    <script src="{{asset('extension/select2/js/select2.min.js')}}"></script> 
    
    <script>
    $(document).ready(function() {
    $('.single-select').select2();
    $('.single-select-multiple').select2();
    });
    </script>
    @yield('script')