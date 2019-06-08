    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- token ajax laravel --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PPK_MEET_ROOM @yield('title') </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('extension/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
       
        <!-- MetisMenu CSS -->
        <link href="{{ asset('extension/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
        
        <!-- Custom CSS -->
        <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('extension/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Social Buttons CSS -->
        <link href="{{ asset('extension/bootstrap-social/bootstrap-social.css') }}" rel="stylesheet">

        <!--page CSS-->
        <link href="{{ asset('css/page.css') }}" rel="stylesheet">

        <!--select 2-->
        <link href="{{ asset('extension/select2/css/select2.min.css') }}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="{{asset('extension/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{asset('extension/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

        <!-- bootstrap-datepicker -->
        <link href="{{asset('extension/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">    
        @yield('stylesheet')                                                                                                                                               
    </head>