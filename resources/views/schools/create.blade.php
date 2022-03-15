@extends('layouts.app')

@section('content')
<div class="col-md-12">

    <h1>{!! trans('general.add_new_school') !!}</h1>

    @include('common.errors')

    {!! Form::open(['route' => 'app.schools.store']) !!}

        @include('schools.fields')

    {!! Form::close() !!}
</div>
@endsection
