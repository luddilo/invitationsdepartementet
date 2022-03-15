@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Partners</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('partners.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($partners->isEmpty())
                <div class="well text-center">No Partners found.</div>
            @else
                @include('partners.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $partners])


    </div>
@endsection