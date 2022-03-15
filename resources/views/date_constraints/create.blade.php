@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.create_date_constraint') !!}</h1>

    {!! Form::open(['route' => 'app.date_constraints.store']) !!}

        @include('date_constraints.fields')

    {!! Form::close() !!}
</div>
@endsection