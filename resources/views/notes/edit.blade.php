@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.edit_notes') !!}</h1>

    {!! Form::model($note, ['route' => ['app.notes.update', $note->id], 'method' => 'patch']) !!}

        @include('notes.fields')

    {!! Form::close() !!}
</div>
@endsection
