@extends('emails.template_raw')

@section('email_content')

    <p>
        Message: {!! $exception->getMessage() !!}
    </p>
    <p>
        Code: {!! $exception->getCode() !!}
    </p>
    <p>
        File: {!! $exception->getFile() !!}
    </p>
    <p>
        Line number: {!! $exception->getLine() !!}
    </p>
    <p>
        Trace: {!! $exception->getTraceAsString() !!}
    </p>

@endsection