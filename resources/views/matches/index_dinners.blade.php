@extends('layouts.app')

@section('content')

        @include('flash::message')

            <div class="col-md-12">
                <h1>{!! trans('general.dinner_suggestions_for') . ' ' . $user->getFullName() !!}</h1>
            </div>
            <div class="col-md-12">

            </div>

            <div class="col-md-12">
                @if($matches->isEmpty())
                    <h2 class="pull-left">{!! trans('general.no_matches_found') !!}.</h2>
                @else
                    <h2 class="pull-left">{!! trans('general.matches') !!}</h2>
                    @include('matches.table_dinners')
                @endif
            </div>
@endsection