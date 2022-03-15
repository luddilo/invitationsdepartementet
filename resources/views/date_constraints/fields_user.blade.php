{!! Form::hidden('constrainable_id', $user->id) !!}
{!! Form::hidden('constrainable_type', 'App\Models\User') !!}

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('from', trans('general.from')) !!}
    {!! Form::text('from', $date, ['id' => 'dateselector', 'data-date-format' => "YYYY-MM-DD HH:m", 'class' => 'dateselector form-control input-append date form_datetime']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('to', trans('general.to')) !!}
    {!! Form::text('to', $date, ['id' => 'dateselector', 'data-date-format' => "YYYY-MM-DD HH:m", 'class' => 'dateselector form-control input-append date form_datetime']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('message', 'Meddelande') !!}
    {!! Form::textarea('message', null, ['id' => 'message', 'rows' => 5, 'class' => 'form-control']) !!}
</div>

@push('scripts')
    @include('scripts.datetimepicker')
    @include('scripts.select2')
@endpush