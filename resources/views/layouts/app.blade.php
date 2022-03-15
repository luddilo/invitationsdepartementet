@extends('layouts.index')

@section('styles')
    <link rel="stylesheet" href="/libs/assets/animate.css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/assets/css/jquery.datatables.css">
    {{--<link rel="stylesheet" href="/assets/css/jquery.datatables.bootstrap.css">--}}
    <link rel="stylesheet" href="/assets/css/font.css" type="text/css" />
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css" />
    <link rel="stylesheet" href="/libs/select2/select2.min.css"  />
    <link rel='stylesheet' href='/libs/fullcalendar/fullcalendar.css' />
    <link rel='stylesheet' href='/libs/datepicker/bootstrap-datepicker3.min.css' />
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
    <style type="text/css">
        html {
            height: 100%;
        }
    </style>
@endsection

@section('app')
    <body style="height: 100%">
        <div class="app app-header-fixed">
            <!-- navbar -->
            @include('layouts.header')
            <!-- / navbar -->

            <!-- menu -->
            @include('layouts.menu')
            <!-- / menu -->

            <!-- content -->
            <div class="app-content">
                <div class="app-content-body">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- /content -->
        </div>

        @include('layouts.settings')

        <script src="/libs/jquery/jquery/dist/jquery-1.11.3.min.js"></script>
        <script src='/libs/jquery/bootstrap/dist/js/bootstrap.js'></script>
        <script src='/libs/moment/moment.min.js'></script>
        <script src='/libs/fullcalendar/fullcalendar.js'></script>
        <script src="/libs/datatables/jquery.dataTables.min.js"></script>
        <script src='/libs/fullcalendar/lang/all.js'></script>
        <script src='/libs/datepicker/bootstrap-datepicker.min.js'></script>
        <script src="/libs/select2/select2.min.js"></script>

        @if(env('APP_ENV') == 'production')
            @include('scripts.analytics')
        @endif
        @stack('scripts')
    </body>
@endsection