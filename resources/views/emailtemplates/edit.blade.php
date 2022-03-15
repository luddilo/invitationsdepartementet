@extends('layouts.app')

@section('content')
    <div class="col-md-12">

        @include('common.errors')

        <h1>Editera emailtemplate</h1>

        {!! Form::model($emailTemplate, ['route' => ['app.emailtemplates.update', $emailTemplate->id], 'method' => 'patch']) !!}

            @include('emailtemplates.fields')

        {!! Form::close() !!}
    </div>

    <div class="col-md-12">
        <h2>Preview av email</h2>
        {!! $preview['view'] !!}
    </div>
@endsection

@push('scripts')
    @include('scripts.datetimepicker')
    @include('scripts.select2')
@endpush