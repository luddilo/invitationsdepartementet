@extends('layouts.outside')

@section('content')
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">

        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <h1 class="pull-left">{!! trans('general.thanks_pending_approval') !!}</h1>
            </div>
        </div>
    </div>
@endsection