@extends('layouts.outside')

@section('content')

    <a href="{!! route('signup') !!}" style="margin-right: 10px" class="pull-right">Tillbaka</a>
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">

        @include('common.errors')

        <h1>Välkommen tillbaka!</h1>
        <p>Vänligen ange den mejladress du använt sedan tidigare</p>

        <form class="form-horizontal" role="form" method="POST" action="{!! route('post_dateselection_another') !!}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">Mejladress</label>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                        Bjud på middag igen
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
