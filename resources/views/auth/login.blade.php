@extends('layouts.outside')

@section('content')

    <a href="{!! route('signup') !!}" style="margin-right: 10px" class="pull-right">Tillbaka</a>
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">

        <h1>{{ trans('general.login') }}</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops! </strong> There were some problems with your input. <br> <br>
                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="/login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">{!! trans('general.username') !!}</label>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">{!! trans('general.password') !!} </label>
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> {!! trans('general.remember_me') !!}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                        Login
                    </button>

                    <a href="{{ url('/password/reset') }}">{{ trans('general.forgot_your_password') }} </a>

                </div>
            </div>
        </form>
    </div>

@endsection
