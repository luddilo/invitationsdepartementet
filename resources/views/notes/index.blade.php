@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                @if(isset($user))
                <h1>{!! trans('general.notes_for') . ' ' . $user->getFullName() !!}</h1>

                <h2>{!! trans('general.add_note') !!}</h2>
                {!! Form::model($user, ['route' => ['app.users.update', $user->id], 'method' => 'patch']) !!}

                    @include('notes.fields')

                {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                @else

                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>{!! trans('general.notes') !!}</h2>
                @if($notes->isEmpty())
                    <div class="well text-center">{{ trans('general.no_notes') }}</div>
                @else
                    @include('notes.table')
                @endif
            </div>
        </div>

    </div>
@endsection