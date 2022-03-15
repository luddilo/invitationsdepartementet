@extends('layouts.app')

@section('content')

        @include('flash::message')

        <div class="col-md-12">
            <h1 class="pull-left">{!! trans('general.preferences') !!}</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.preferences.create') !!}">{!! trans('general.add_new') !!}</a>
        </div>

        <div class="col-md-12">
            @if($preferences->isEmpty())
                <div class="well text-center">{!! trans('general.no_preferences_found') !!}.</div>
            @else
                @include('preferences.table')
            @endif

            @include('common.paginate', ['records' => $preferences])
        </div>

@endsection