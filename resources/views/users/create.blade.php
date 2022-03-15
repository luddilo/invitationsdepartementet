@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @include('common.errors')
    <h1>{!! trans('general.create_new_user') !!}</h1>
    {!! Form::open(['route' => 'app.users.store']) !!}

        @include('users.fields')

    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
</div>
@endsection

@push('scripts')
    @include('scripts.select2')
    @include('scripts.add_more_children')
    @include('scripts.add_more_partners')
@endpush
