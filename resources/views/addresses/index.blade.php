@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Addresses</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.addresses.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($addresses->isEmpty())
                <div class="well text-center">No Addresses found.</div>
            @else
                @include('addresses.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $addresses])


    </div>
@endsection