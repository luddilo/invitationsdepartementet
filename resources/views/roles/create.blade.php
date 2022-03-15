@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'app.roles.store']) !!}

        @include('roles.fields')

    {!! Form::close() !!}
</div>
@endsection
