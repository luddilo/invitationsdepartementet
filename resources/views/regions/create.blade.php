@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')
    <h1>{!! trans('general.add_new_region') !!}</h1>

    {!! Form::open(['route' => 'app.regions.store']) !!}

        @include('regions.fields')

    {!! Form::close() !!}
</div>
@endsection