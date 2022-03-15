@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($partner, ['route' => ['partners.update', $partner->id], 'method' => 'patch']) !!}

        @include('partners.fields')

    {!! Form::close() !!}
</div>
@endsection
