@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($child, ['route' => ['app.children.update', $child->id], 'method' => 'patch']) !!}

        @include('children.fields')

    {!! Form::close() !!}
</div>
@endsection
