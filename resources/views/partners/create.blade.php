@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'partners.store']) !!}

        @include('partners.fields')

    {!! Form::close() !!}
</div>
@endsection
