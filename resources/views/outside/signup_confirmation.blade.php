@extends('layouts.outside')

@section('content')

    @include('common.errors')

    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">
        <div class="col-md-12">
            <h1>{!! trans('general.thanks_for_signup') !!}!</h1>

            @if(isset($message))
                <p>{!! nl2br($message) !!}</p>
            @else
                <p>Vi har skickat ett email med instruktioner, det bör komma fram inom några minuter.</p>
            @endif

            <p>Följ oss gärna på
            <a style="margin-left:3px; margin-right: 3px;" class="btn btn-default btn-sm" href="http://www.facebook.com/invitationsdepartementet"><i class="fa fa-facebook-square"></i> Facebook</a> så länge.</p>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
