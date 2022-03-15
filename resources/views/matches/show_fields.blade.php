<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $match->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $match->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $match->updated_at !!}</p>
</div>

<!-- Status Id Field -->
<div class="form-group">
    {!! Form::label('status_id', 'Status Id:') !!}
    <p>{!! $match->status_id !!}</p>
</div>

<!-- Number Of Adults Field -->
<div class="form-group">
    {!! Form::label('number_of_adults', 'Number Of Adults:') !!}
    <p>{!! $match->number_of_adults !!}</p>
</div>

<!-- Number Of Children Field -->
<div class="form-group">
    {!! Form::label('number_of_children', 'Number Of Children:') !!}
    <p>{!! $match->number_of_children !!}</p>
</div>

