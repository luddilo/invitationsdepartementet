@extends('emails.template_raw')

@section('email_content')

    <p id="intro">
        {!! sprintf(config('constants.emailTemplateStatics')['intro_greeting'], $user->first_name) !!}
    </p>

    @foreach($emailParagraphs as $key => $paragraph)
        <p id="paragraph {!! $key !!}">
            {!! isset($skip_nl2br) && $skip_nl2br ? $paragraph : nl2br($paragraph) !!}
        </p>
    @endforeach

    <p id="outtro">
        {!! config('constants.emailTemplateStatics')['outtro_greeting'] !!}<br>
        {!! $sender != null ? $sender->first_name . '<br>' : '' !!}
        Invitationsdepartementet {!! $user->region->name !!}
    </p>
    <p id="signature">
        @if(!empty($signature))
            {!! nl2br($signature) !!}
        @endif
    </p>

@endsection