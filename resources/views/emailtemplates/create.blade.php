@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>Ny emailtemplate</h1>

    {!! Form::open(['route' => 'app.emailtemplates.store']) !!}

        @include('emailtemplates.fields')

    {!! Form::close() !!}
</div>
@endsection

@push('scripts')
    @include('scripts.datetimepicker')
    @include('scripts.select2')
@endpush