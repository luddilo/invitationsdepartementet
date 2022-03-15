@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'app.children.store']) !!}

        @include('children.fields')

    {!! Form::close() !!}
</div>
@endsection
