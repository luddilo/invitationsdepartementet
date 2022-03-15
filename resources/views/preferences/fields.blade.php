<!--- Name Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('name_guesting', trans('general.preference_guesting')) !!}
    {!! Form::text('name_guesting', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('name_hosting', trans('general.preference_hosting')) !!}
    {!! Form::text('name_hosting', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('type', trans('general.type')) !!}
    {!! Form::select('type', config('constants.PREFERENCE_TYPES')[config('app.locale')], null, ['class' => 'form-control']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
</div>
