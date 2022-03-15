@extends('layouts.outside')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Invitationsdepartementet Admin (Beta)</h1>
                    <a class="btn btn-lg btn-default" href="/register">{!! trans('general.register') !!}</a>
                    <a class="btn btn-lg btn-default" href="/login">{!! trans('general.login') !!}</a>
                </div>
            </div>
        </div>
@endsection