@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.edit_preference') !!}</h1>

    {!! Form::model($preference, ['route' => ['app.preferences.update', $preference->id], 'method' => 'patch']) !!}

        @include('preferences.fields')

    {!! Form::close() !!}
</div>
@endsection
