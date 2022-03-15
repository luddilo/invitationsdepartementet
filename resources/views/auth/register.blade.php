@extends('layouts.outside')

@section('content')

<a href="{!! route('signup') !!}" style="margin-right: 10px" class="pull-right">Tillbaka</a>
<div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">

    <h1>{!! trans('general.register')!!}</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>

    @endif

    <form class="form-horizontal" role="form" method="POST" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="col-md-4 control-label">{!! trans('general.first_name') !!}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{!! trans('general.last_name') !!}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{!! trans('general.email') !!}</label>
            <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('region_id', trans('general.region'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('region_id', $regions, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{!! trans('general.password') !!}</label>
            <div class="col-md-6">
                <input type="password" class="form-control" name="password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">{!! trans('general.confirm_password') !!}</label>
            <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    {!! trans('general.register') !!}
                </button>

            </div>
        </div>
    </form>
</div>

@endsection