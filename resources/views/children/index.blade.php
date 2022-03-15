@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Children</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.children.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($children->isEmpty())
                <div class="well text-center">No Children found.</div>
            @else
                @include('children.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $children])


    </div>
@endsection