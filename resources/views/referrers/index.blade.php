@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Referrers</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.referrers.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($referrers->isEmpty())
                <div class="well text-center">No Referrers found.</div>
            @else
                @include('referrers.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $referrers])


    </div>
@endsection