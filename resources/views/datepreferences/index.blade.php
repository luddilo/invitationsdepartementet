@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Datepreferences</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('datepreferences.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($datepreferences->isEmpty())
                <div class="well text-center">No Datepreferences found.</div>
            @else
                @include('datepreferences.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $datepreferences])


    </div>
@endsection