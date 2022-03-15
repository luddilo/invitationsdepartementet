@extends('layouts.app')

@section('content')
    <div class="col-md-12">

        @include('common.errors')

        <h1>Förhandsgranska och skicka matchningsemail</h1>

        {!! Form::open(['route' => ['app.matches.send_email', $match->id], 'method' => 'post']) !!}

            {!! Form::hidden('_email_type', $email_type) !!}
            {!! Form::label('_title', 'Titel') !!}
            {!! Form::text('_title', $title, ['id' => 'title', 'class' => 'form-control']) !!}

            {!! Form::label('_content', 'Förhandsgranskning') !!}
            {!! Form::textarea('_content', $content, ['id' => 'content', 'class' => 'form-control']) !!}
            {!! Form::submit('Skicka email', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px']) !!}
        {!! Form::close() !!}
    </div>
@endsection

@push('scripts')
    @include('scripts.datetimepicker')
    @include('scripts.select2')
    @include('scripts.add_more_children')
    @include('scripts.add_more_partners')
    <script src="/libs/ckeditor/ckeditor.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            CKEDITOR.replace('content', {
                language: 'sv',
                height: '500px'
            });
        });
    </script>
@endpush