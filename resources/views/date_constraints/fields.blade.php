
@if (Auth::user()->hasRole('Administrator'))
    <div class="form-group col-sm-6 col-lg-4">
        {!! Form::label('constrainable_id', 'Region') !!}
        {!! Form::select('constrainable_id', $regions, null, ['class' => 'form-control']) !!}
    </div>
@else
    {!! Form::hidden('constrainable_id', Auth::user()->region->id) !!}
@endif
    {!! Form::hidden('constrainable_type', 'App\Models\Region') !!}

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('from', trans('general.from')) !!}
    {!! Form::text('from', null, ['id' => 'dateselector', 'data-date-format' => "YYYY-MM-DD HH:m", 'class' => 'dateselector form-control input-append date form_datetime']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('to', trans('general.to')) !!}
    {!! Form::text('to', null, ['id' => 'dateselector', 'data-date-format' => "YYYY-MM-DD HH:m", 'class' => 'dateselector form-control input-append date form_datetime']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('message', trans('general.message')) !!}
    {!! Form::textarea('message', null, ['id' => 'message', 'rows' => 5, 'class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('message', 'Meddelande efter signup') !!}
    {!! Form::textarea('confirmation_signup_message', null, ['rows' => 5, 'class' => 'form-control']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
</div>

@push('scripts')
    @include('scripts.datetimepicker')
    @include('scripts.select2')
@endpush
