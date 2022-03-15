@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.edit_referrer') !!}</h1>

    {!! Form::model($referrer, ['route' => ['app.referrers.update', $referrer->id], 'method' => 'patch']) !!}

        @include('referrers.fields')

    {!! Form::close() !!}
</div>
@endsection
