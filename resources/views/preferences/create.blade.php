@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.add_new_preference') !!}</h1>

    {!! Form::open(['route' => 'app.preferences.store']) !!}

        @include('preferences.fields')

    {!! Form::close() !!}
</div>
@endsection
