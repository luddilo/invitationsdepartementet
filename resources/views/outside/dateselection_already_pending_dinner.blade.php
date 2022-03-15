@extends('layouts.outside')

@section('content')
    @include('common.errors')
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">
        <div class="col-md-12">
            <h1>Det ser ut som att du redan har en middag inplanerad</h1>
            <h2>Har du frågor är du välkommen att höra av dig till oss på {!! $contact_email !!}.<br/><br/>
                Följ oss gärna på
                <a style="margin-left:3px; margin-right: 3px;" class="btn btn-default btn-sm" href="http://www.facebook.com/invitationsdepartementet"><i class="fa fa-facebook-square"></i> Facebook</a> så länge.</h2>
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@push('scripts')
@endpush
