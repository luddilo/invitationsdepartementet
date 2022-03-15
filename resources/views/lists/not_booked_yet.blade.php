@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left">
              {{ trans('general.lists') }}
            </h1>
        </div>
    </div>

    <ul>
        <li>
        </li>
    </ul>
@endsection