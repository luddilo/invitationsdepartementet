@extends('layouts.app')

@section('content')

        @include('flash::message')
        <div class="col-md-12">
            <h1 class="pull-left">{!! trans('general.dinners_for_user') . ' ' . $user->getFullName() !!}</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px; margin-left: 5px" href="{!! isset($user) ? route('app.users.dinners.create', $user->id) : route('app.dinners.create') !!}                ">{!! trans('general.add_new') !!}</a>
        </div>

        <div class="col-md-12">

            @if(!$hosting_dinners_without_matches->isEmpty())
                <h3>{!! trans('general.without_matches') !!}</h3>
                @include('dinners.table', ['dinners' => $hosting_dinners_without_matches])

            @endif

            @if(!$hosting_dinners_with_matches->isEmpty())
                <h3>{!! trans('general.with_matches') !!}</h3>
                @include('dinners.table', ['dinners' => $hosting_dinners_with_matches])
            @endif

            @if(!$guesting_dinners->isEmpty())
                <h3>{!! trans('general.guesting_dinners') !!}</h3>
                @include('dinners.table', ['dinners' => $guesting_dinners])

            @endif
        </div>
@endsection