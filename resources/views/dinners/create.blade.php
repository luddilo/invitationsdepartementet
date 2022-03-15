@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.create_dinner_for') . ' ' . $user->getFullName() !!}</h1>

    {!! Form::open(['route' => 'app.dinners.store']) !!}

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