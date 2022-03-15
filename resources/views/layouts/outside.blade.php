@extends('layouts.index')

@section('styles')
    <link rel="stylesheet" href="/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
    {{--<link rel="stylesheet" href="/assets/css/jquery.datatables.bootstrap.css">--}}
    <link rel="stylesheet" href="/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/css/font.css" type="text/css" />
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css" />
    <link rel="stylesheet" href="/libs/select2/select2.min.css"  />
    <link rel="stylesheet" href="/assets/css/style.css" />
@endsection

@section('app')
    <body>
        @yield('content')

        <script src="/libs/jquery/jquery/dist/jquery-1.11.3.min.js"></script>
        <script src='/libs/jquery/bootstrap/dist/js/bootstrap.js'></script>
        <script src='/libs/moment/moment.min.js'></script>
        <script src="/libs/select2/select2.min.js"></script>

        @if(env('APP_ENV') == 'production'))
            @include('scripts.analytics')
        @endif

        @stack('scripts')
    </body>
@endsection


