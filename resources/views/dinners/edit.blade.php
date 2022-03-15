@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.edit_dinner') !!}</h1>

    {!! Form::model($dinner, ['route' => ['app.dinners.update', $dinner->id], 'method' => 'patch']) !!}

        @include('dinners.fields')

    {!! Form::close() !!}
</div>
@endsection

@push('scripts')
    @include('scripts.datetimepicker')
    @include('scripts.select2')
    @include('scripts.add_more_children')
    @include('scripts.add_more_partners')
@endpush