<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $region->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $region->name !!}</p>
</div>

<!-- Capacity Dinners Per Week Field -->
<div class="form-group">
    {!! Form::label('capacity_dinners_per_week', 'Capacity Dinners Per Week:') !!}
    <p>{!! $region->capacity_dinners_per_week !!}</p>
</div>

<!-- Minimum Days Notice Dinner Field -->
<div class="form-group">
    {!! Form::label('minimum_days_notice_dinner', 'Minimum Days Notice Dinner:') !!}
    <p>{!! $region->minimum_days_notice_dinner !!}</p>
</div>

<!-- Inactive Until Field -->
<div class="form-group">
    {!! Form::label('inactive_until', 'Inactive Until:') !!}
    <p>{!! $region->inactive_until !!}</p>
</div>

<!-- Inactive From Field -->
<div class="form-group">
    {!! Form::label('inactive_from', 'Inactive From:') !!}
    <p>{!! $region->inactive_from !!}</p>
</div>

<!-- Address Id Field -->
<div class="form-group">
    {!! Form::label('address_id', 'Address Id:') !!}
    <p>{!! $region->address_id !!}</p>
</div>

<!-- Responsible User Id Field -->
<div class="form-group">
    {!! Form::label('responsible_user_id', 'Responsible User Id:') !!}
    <p>{!! $region->responsible_user_id !!}</p>
</div>

