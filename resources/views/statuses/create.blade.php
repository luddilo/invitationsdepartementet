@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'app.statuses.store']) !!}

        @include('statuses.fields')

    {!! Form::close() !!}
</div>
@endsection
