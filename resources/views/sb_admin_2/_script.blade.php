    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('extension/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('extension/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/sb-admin-2.js')}}"></script> 

  <!-- DataTables JavaScript -->
  <script src="{{asset('extension/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('extension/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('extension/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    @yield('script')