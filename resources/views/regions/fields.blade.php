<!--- Name Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('name', trans('general.name')) !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('email', trans('general.email')) !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!--- Responsible User Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('responsible_user_id', trans('general.responsible_ambassador')) !!}
    {!! Form::select('responsible_user_id', $users, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('minimum_days_notice_dinner', 'Minsta framförhållning middag (dagar)') !!}
    {!! Form::number('minimum_days_notice_dinner', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('user_dateselection', 'Användare ska kunna välja datum själva') !!}
    {!! Form::hidden('user_dateselection', 0) !!}
    {!! Form::checkbox('user_dateselection', 1, null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
</div>
