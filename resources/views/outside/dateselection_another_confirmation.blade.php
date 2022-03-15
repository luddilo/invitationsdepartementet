@extends('layouts.outside')

@section('content')
    @include('common.errors')
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">
        <div class="col-md-12">
            <h1>Tack!</h1>
            <h2>Vi hör av oss senast, och oftast, 48h innan middagen med information om din gäst. Om vi inte skulle hitta någon och behöver skjuta på middagen, hör vi givetvis också av oss.
                <br/><br/>
                Följ oss gärna på
                <a style="margin-left:3px; margin-right: 3px;" class="btn btn-default btn-sm" href="http://www.facebook.com/invitationsdepartementet">
                    <i class="fa fa-facebook-square"></i>Facebook
                </a> så länge.
            </h2>
        </div>
    </div>

@endsection

@push('scripts')
@endpush
