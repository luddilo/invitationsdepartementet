@extends('layouts.app')

@section('content')
<div class="col-md-12">

    <h1>{!! trans('general.edit_school') !!}</h1>
    @include('common.errors')

    {!! Form::model($school, ['route' => ['app.schools.update', $school->id], 'method' => 'patch']) !!}

        @include('schools.fields')

    {!! Form::close() !!}
</div>
@endsection
