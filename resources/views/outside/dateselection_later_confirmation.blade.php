@extends('layouts.outside')

@section('content')
    @include('common.errors')
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">
        <div class="col-md-12">
            <h1>Tack för att du vill äta middag!<br>
            <small>Du kan närsomhelst logga in i kalendern med din mejladress och välja datum.</small>
            </h1>
            <p>De flesta middagar bokas inom samma vecka som en signar upp. Stäm av med den eller de som du vill bjuda på middag med, så hör vi av oss med en påminnelse imorgon.</p>

            <p>Tills dess - ha en fin dag!</p>
            Följ oss gärna på
            <a style="margin-left:3px; margin-right: 3px;" class="btn btn-default btn-sm" href="http://www.facebook.com/invitationsdepartementet"><i class="fa fa-facebook-square"></i> Facebook</a> så länge.
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@push('scripts')
@endpush
