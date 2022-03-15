@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        @include('flash::message')

            <h1 class="pull-left">Regions</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.regions.create') !!}">Add New</a>

            @if($regions->isEmpty())
                <div class="well text-center">No Regions found.</div>
            @else
                @include('regions.table')
            @endif


    </div>
@endsection