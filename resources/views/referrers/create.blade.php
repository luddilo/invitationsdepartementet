@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.create_referrer') !!}</h1>

    {!! Form::open(['route' => 'app.referrers.store']) !!}

        @include('referrers.fields')

    {!! Form::close() !!}
</div>
@endsection