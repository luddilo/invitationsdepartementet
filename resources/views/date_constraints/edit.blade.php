@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.edit_date_constraint') !!}</h1>

    {!! Form::model($date_constraint, ['route' => ['app.date_constraints.update', $date_constraint->id], 'method' => 'patch']) !!}

        @include('date_constraints.fields')

    {!! Form::close() !!}
</div>
@endsection