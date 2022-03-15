@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'app.matches.store']) !!}

        @include('matches.fields')

    {!! Form::close() !!}
</div>
@endsection
