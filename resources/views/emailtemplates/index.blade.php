@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Emailmallar</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('app.emailtemplates.create') !!}">Skapa ny</a>
        </div>

        <div class="row">
            @if(count($emailTemplates) == 0)
                <div class="well text-center">Inga emailtemplates skapade.</div>
            @else
                @include('emailtemplates.table')
            @endif
        </div>


    </div>
@endsection