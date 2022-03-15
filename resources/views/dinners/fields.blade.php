<h2>{!! trans('general.dinner_information') !!}</h2>
<div class="row">
    <div class="col-sm-12">
        <!--- Date Field --->
        <div class="form-group col-sm-6">
            {!! Form::label('date', trans('general.date')) !!}
            {!! Form::text('date', isset($default_date) ? $default_date : null, ['id' => 'dateselector', 'data-date-format' => "YYYY-MM-DD HH:m", 'class' => 'dateselector form-control input-append date form_datetime']) !!}
        </div>

        <!--- Quantity Established Field --->
        <div class="form-group col-sm-6">
            {!! Form::label('guests', trans('general.guests')) !!}
            {!! Form::select('guests', Config::get('constants.DINNER_GUEST_CAPACITY')[Config::get('app.locale')], null, ['class' => 'form-control']) !!}
        </div>

            {!! Form::hidden('user_id', isset($user) ? $user->id : null) !!}

        @include('addresses.fields')

        <div class="form-group col-sm-6">
            {!! Form::label('other_info', trans('general.other_information')) !!}
            {!! Form::textarea('other_info', isset($dinner) ? $dinner->other_info : null, ['id' => 'other_info', 'rows' => '3', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6">
            <h2>{!! trans('general.dinner_company') !!}
                <button id="add_more_partners" style="margin-left: 10px" class="btn btn-xs btn-info">{!! trans('general.add_adult') !!}</button>
                <button id="add_more_children" style="margin-left: 10px" class="btn btn-xs btn-success">{!! trans('general.add_child') !!}</button>
            </h2>
            @include('partials.partners_input')
            @include('partials.children_input')
        </div>
    </div>
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
</div>

@push('scripts')
<script type="text/javascript">

    $('#user_select').select2();
    $('#user_select').on('change',  function(){
        var user_id = $(this).val();
        var api_route = '{!! route('api.v1.addresses.user', null) !!}' + '/' + user_id;
        $.ajax({
            url: api_route
        }).done(function(results) {
            $('#address_street').val(results.data.street);
            $('#address_zip').val(results.data.zipcode);
            $('#address_city').val(results.data.city);
            console.log('Populated address data');
        }).error(function() {
            $('#address_street').val('');
            $('#address_zip').val('');
            $('#address_city').val('');
            console.log('Error: user has no address data');
        });

        var api_route = '{!! route('api.v1.users.index') !!}' + '/' + user_id;
        $.ajax({
            url: api_route
        }).done(function(results) {
            $('#other_info').val(results.data.other_info);
            console.log('Populated notes data');
        }).error(function() {
            $('#other_info').val('');
            console.log('Error: user has no notes data');
        });
    });


</script>
@endpush