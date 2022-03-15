@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('common.errors')


        {!! Form::model($user, ['route' => ['app.users.update', $user->id], 'method' => 'put']) !!}

        <div class="row">
            <div class="col-md-12">
                <h1 class="pull-left">{!! trans('general.edit_user') !!}</h1>
                {!! Form::submit(trans('general.save'), ['style' => 'margin-top: 25px', 'class' => 'pull-right btn btn-primary']) !!}
            </div>
        </div>
            @include('users.fields')

        <div class="form-group">
            {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

@push('scripts')
    @include('scripts.select2')
    @include('scripts.add_more_children')
    @include('scripts.add_more_partners')
@endpush
