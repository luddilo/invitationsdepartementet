@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'datepreferences.store']) !!}

        @include('datepreferences.fields')

    {!! Form::close() !!}
</div>
@endsection
