@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($status, ['route' => ['app.statuses.update', $status->id], 'method' => 'patch']) !!}

        @include('statuses.fields')

    {!! Form::close() !!}
</div>
@endsection
