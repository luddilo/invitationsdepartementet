@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">{!! trans('general.date_constraints') !!}</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.date_constraints.create') !!}">Skapa ny</a>
        </div>

        <div class="row">
            @if(count($date_constraints) == 0)
                <div class="well text-center">Inga inaktiva perioder.</div>
            @else
                @include('date_constraints.table')
            @endif
        </div>


    </div>
@endsection