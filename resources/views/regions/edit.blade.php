@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')
    <h1>{!! trans('general.edit_region') !!}</h1>

    {!! Form::model($region, ['route' => ['app.regions.update', $region->id], 'method' => 'patch']) !!}

        @include('regions.fields')

    {!! Form::close() !!}
</div>
@endsection