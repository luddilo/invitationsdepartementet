<!--- Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('id', 'Id:') !!}
	{!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!--- Gender Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('gender', 'Gender:') !!}
	{!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!--- Type Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('type', 'Type:') !!}
	{!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!--- Partnerable Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('partnerable_id', 'Partnerable Id:') !!}
	{!! Form::number('partnerable_id', null, ['class' => 'form-control']) !!}
</div>

<!--- Partnerable Type Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('partnerable_type', 'Partnerable Type:') !!}
	{!! Form::text('partnerable_type', null, ['class' => 'form-control']) !!}
</div>

<!--- Created At Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('created_at', 'Created At:') !!}
	{!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!--- Updated At Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('updated_at', 'Updated At:') !!}
	{!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
