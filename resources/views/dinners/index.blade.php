@extends('layouts.app')

@section('content')

        @include('flash::message')
        <div class="col-md-12">
            <h1 class="pull-left">{!! trans('general.dinners') !!}</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px; margin-left: 5px" href="{!! isset($user) ? route('app.users.dinners.create', $user->id) : route('app.dinners.create') !!}                ">{!! trans('general.add_new') !!}</a>
        </div>

        <div class="col-md-12">

            @if(!$dinners->isEmpty())
                <h3>{!! $header !!}</h3>
                @include('dinners.table', ['dinners' => $dinners])
                {!! $dinners->render() !!}
            @endif

        </div>
@endsection