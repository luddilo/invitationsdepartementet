@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Roles</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.roles.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($roles->isEmpty())
                <div class="well text-center">No Roles found.</div>
            @else
                @include('roles.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $roles])


    </div>
@endsection