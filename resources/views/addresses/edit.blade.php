@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($address, ['route' => ['app.addresses.update', $address->id], 'method' => 'patch']) !!}

        @include('addresses.fields')

        <!--- Submit Field --->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
</div>
@endsection
