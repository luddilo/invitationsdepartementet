@extends('layouts.app')

@section('content')
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <h1 class="pull-left">
                  {!! $role or trans('general.users') !!}
                </h1>
            </div>
        </div>

        @include('users.table')
@endsection