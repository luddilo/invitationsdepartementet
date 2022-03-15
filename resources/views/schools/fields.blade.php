<!--- Name Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('name', trans('general.name')) !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!--- Level Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('level', trans('general.level')) !!}
	{!! Form::text('level', null, ['class' => 'form-control']) !!}
</div>


@if(Auth::user()->hasRole('Administrator'))
    <!--- Region Id Field --->
    <div class="form-group col-sm-6 col-lg-4">
        {!! Form::label('region_id', trans('general.region')) !!}
        {!! Form::select('region_id', $regions, null, ['class' => 'form-control']) !!}
    </div>
@else
    {!! Form::hidden('region_id', Auth::user()->getRegion()->id) !!}
@endif



<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
</div>
