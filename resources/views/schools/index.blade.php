@extends('layouts.app')

@section('content')


        @include('flash::message')

        <div class="col-md-12">
            <h1 class="pull-left">{!! trans('general.schools') !!}
                <a class="btn btn-primary pull-right" href="{!! route('app.schools.create') !!}">{!! trans('general.add_new') !!}</a>
            </h1>
        </div>

        <div class="col-md-12">
            @if($schools->isEmpty())
                <div class="well text-center">{!! trans('general.no_schools_found') !!}</div>
            @else
                @include('schools.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $schools])

@endsection