@extends('layouts.app')

@section('content')
    <div class="col-md-12">

        @include('common.errors')

        <h1>{{ trans('email.preview') }}: {{ $title }}</h1>

        {!! Form::open(['route' => ['app.matches.send_email', $match->id], 'method' => 'post']) !!}

            {!! Form::hidden('_email_type', $email_type) !!}

            {!! Form::label('_to', trans('email.send_to')) !!}
            {!! Form::text('_to', $to, ['disabled' => 'disabled', 'class' => 'form-control']) !!}

            {!! Form::label('_title', trans('email.title')) !!}
            {!! Form::text('_title', $title, ['id' => 'title', 'class' => 'form-control']) !!}

            {!! Form::label('_content', trans('email.preview')) !!}
            {!! Form::textarea('_content', $content, ['id' => 'content', 'class' => 'form-control']) !!}
            {!! Form::submit(trans('email.send_submit'), ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px']) !!}
        {!! Form::close() !!}
    </div>
@endsection

@push('scripts')
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