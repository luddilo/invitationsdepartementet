@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($datepreference, ['route' => ['datepreferences.update', $datepreference->id], 'method' => 'patch']) !!}

        @include('datepreferences.fields')

    {!! Form::close() !!}
</div>
@endsection
