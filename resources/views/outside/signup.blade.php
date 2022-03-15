@extends('layouts.outside')

@section('content')


        <a href="{!! route('login') !!}" style="margin-right: 10px" class="pull-right">Admin</a>
        <div class="container-fluid wrapper-landing">
            @include('common.errors')

            {!! Form::open(['route' => 'post_signup']) !!}

            <div class="col-xs-12 col-sm-8 col-sm-offset-2 alert alert-info text-center">
                <h4>
                    <i class="fa fa-info-circle"></i> Har du redan signat upp och vill välja ett datum för middag?
                </h4>
                <a href="{!! route('apply_for_another_dinner') !!}" class="btn btn-primary">Klicka här</a>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <h1>{!! trans('general.signup_header') !!}
                    @if(isset($region))
                        i {!! $region->name !!}
                    @endif
                </h1>

                @if(count($messages) > 0)
                    @include('common.message', $messages)
                @endif


                <p style="font-style: italic">
                    {!! trans('general.signup_tagline') !!}
                    <a data-toggle="collapse" style="text-decoration: underline" href="#how_it_works">
                        {!! trans('general.how_does_it_work') !!}
                    </a>
                </p>

                <div class="panel panel-default">
                    <div id="how_it_works" class="panel-collapse collapse">
                        <div class="panel-body">
                            <i class="fa fa-info-circle"></i> {!! trans('general.signup_intro') !!}
                        </div>

                        <div class="panel-footer">
                            {!! trans('general.signup_faq') !!}
                            <a href="http://invitationsdepartementet.eu/#new-page-section"><b>här</b></a>.
                        </div>
                    </div>
                </div>
                @include('users.fields')

                <div class="row">
                    <div class="col-md-12">

                        <div class="pull-left checkbox">
                            <label>
                                {!! Form::checkbox('agree_to_terms', 1, null, ['id' => 'agree_to_terms', 'class' => 'agree_to']) !!}
                                {!! trans('general.agree_to_terms') !!}
                            </label>
                        </div>
                        <div class="pull-left checkbox">
                            <label>
                                {!! Form::checkbox('agree_to_pul', 1, null, ['id' => 'agree_to_pul', 'class' => 'agree_to']) !!}
                                {!! trans('general.agree_to_pul') !!}
                            <a data-toggle="collapse" class="text-u-l" href="#extended_terms">Läs mer.</a>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div id="extended_terms" class="panel-collapse collapse">
                        <div class="panel-body">
                            {!! trans('general.extended_terms') !!}
                        </div>
                    </div>
                </div>

                {!! Form::submit(trans('general.eat_dinner'), ['id' => 'submit', 'disabled' => 'disabled', 'class' => 'pull-left btn btn-lg btn-primary']) !!}

            </div>

            {!! Form::close() !!}
        </div>

@endsection

@push('scripts')
@include('scripts.select2')
@include('scripts.agree_to_terms')
@include('scripts.add_more_children')
@include('scripts.add_more_partners')
@endpush
