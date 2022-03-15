@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.create_note') !!}</h1>

    {!! Form::open(['route' => 'app.notes.store']) !!}

        @include('notes.fields')

    {!! Form::close() !!}
</div>
@endsection