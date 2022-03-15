@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($match, ['route' => ['app.matches.update', $match->id], 'method' => 'patch']) !!}

        @include('matches.fields')

    {!! Form::close() !!}
</div>
@endsection
