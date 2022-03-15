<h2>{!! trans('general.personal_details') !!}</h2>
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('first_name', trans('general.first_name')) !!}
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('last_name', trans('general.last_name')) !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('fluent', trans('general.language_proficiency')) !!}
        {!! Form::select('fluent', Config::get('constants.LANGUAGE_PROFICIENCIES')[Config::get('app.locale')], null, ['id' => 'language_proficiency', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('age', trans('general.age')) !!}
        {!! Form::select('age', Config::get('constants.AGE')[Config::get('app.locale')], null, ['id' => 'age', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('nationality', trans('general.nationality')) !!}
        {!! Form::select('nationality', Config::get('constants.NATIONALITIES'), null, ['class' => 'form-control']) !!}
    </div>

    <!--- Gender Field --->
    <div class="form-group col-sm-6">
        {!! Form::label('gender', trans('general.gender')) !!}
        {!! Form::select('gender', Config::get('constants.GENDERS')[Config::get('app.locale')], null, ['class' => 'form-control']) !!}
    </div>

    @if(Auth::guest() || Auth::user()->hasRoles(['Ambassador', 'Administrator']))
        <div class="form-group col-sm-6 visible-if-not-fluent">
            {!! Form::label('school_id', trans('general.language_school')) !!}
            {!! Form::select('school_id', $schools, null, ['class' => 'form-control']) !!}
        </div>
    @endif

    @if(Auth::user() && !isset($region)) <!-- IF WE HAVE A USER LOGGED IN. WE ALWAYS HAVE REGIONS SET IN THIS CASE -->

        @if(Auth::user()->hasRole('Administrator'))
            <div class="form-group col-sm-6">
                {!! Form::label('region_id', trans('general.region')) !!}
                {!! Form::select('region_id', $regions, isset($user) ? $user->region->id : Auth::user()->region->id, ['id' => 'region', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('role_list[]', trans('general.role')) !!}
                {!! Form::select('role_list[]', $roles, isset($user) ? null : App\Models\Role::where('name', 'Member')->first()->id, ['id' => 'role_list', 'multiple' => 'multiple', 'class' => 'multiple form-control']) !!}
            </div>
        @else
            {!! Form::hidden('region_id', isset($user) ? $user->region->id : Auth::user()->region->id) !!}
            {!! Form::hidden('role_list[0]', isset($user) ? null : App\Models\Role::where('name', 'Member')->first()->id) !!}
        @endif
    @else
        @if(isset($region))
            {!! Form::hidden('region_id', $region->id) !!}
        @elseif(isset($regions))
            <div class="form-group col-sm-6">
                {!! Form::label('region_id', trans('general.region')) !!}
                {!! Form::select('region_id', $regions, null, ['id' => 'region', 'class' => 'form-control']) !!}
            </div>
        @endif
        {!! Form::hidden('role_list[0]', isset($user) ? null : App\Models\Role::where('name', 'Member')->first()->id) !!}
    @endif

    @include('addresses.fields')

    <div class="form-group col-sm-6">
        {!! Form::label('other_info', trans('general.other_information')) !!}
        {!! Form::textarea('other_info', null, ['placeholder' => trans('general.other_information_placeholder'), 'rows' => '3', 'class' => ' form-control']) !!}
    </div>

    @if(Auth::guest())
        <div class="form-group col-sm-6">
            {!! Form::label('referrer_id', trans('general.how_did_you_find_us')) !!}
            {!! Form::select('referrer_id', $referrers, null, ['id' => 'referrer', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6 visible_if_referred_by_friend">
            {!! Form::label('referrer_name', trans('general.what_is_your_friends_name')) !!}
            {!! Form::text('referrer_name', null, ['id' => 'referrer_name', 'class' => 'form-control']) !!}
        </div>
    @endif
</div>

<h2>{!! trans('general.contact_details') !!}</h2>
<!--- Email Field --->
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('email', trans('general.email')) !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <!--- Phone Field --->
    <div class="form-group col-sm-6">
        {!! Form::label('phone', trans('general.phone')) !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<h2>{!! trans('general.dinner_preferences') !!}</h2>

<div class="row">
    <div class="form-group col-sm-12">
        @include('partials.guest_host_checkbox_radios')
    </div>
    <div class="form-group col-sm-6 visible-if-hosting">
            {!! Form::label('preference_list_hosting[]', trans('general.preferences_hosting')) !!}
            <span style="font-style: italic">({!! trans('general.can_select_several') !!})</span>
            {!! Form::select('preference_list_hosting[]', $preferences_hosting, null, ['id' => 'preference_list_hosting', 'multiple' => 'multiple', 'class' => 'multiple form-control']) !!}
    </div>
    <div class="form-group col-sm-6 visible-if-hosting">
        {!! Form::label('guests', trans('general.guests')) !!}
        <span style="font-style: italic">({!! trans('general.guest_description') !!})</span>
        {!! Form::select('guests', Config::get('constants.DINNER_GUEST_CAPACITY')[Config::get('app.locale')], 1, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6 visible-if-guesting">
        {!! Form::label('preference_list_guesting[]', trans('general.preferences_guesting')) !!}
        <span style="font-style: italic">({!! trans('general.can_select_several') !!})</span>
        {!! Form::select('preference_list_guesting[]', $preferences_guesting, null, ['id' => 'preference_list_guesting', 'multiple' => 'multiple', 'class' => 'multiple form-control']) !!}
    </div>
    <div class="form-group col-sm-6 visible-if-guesting">
        {!! Form::label('datepreference_list[]', trans('general.date_availability')) !!}
        <span style="font-style: italic">({!! trans('general.can_select_several') !!})</span>
        {!! Form::select('datepreference_list[]', Config::get('constants.WEEKDAYS')[Config::get('app.locale')], null, ['id' => 'preference_list', 'multiple' => 'multiple', 'class' => 'multiple form-control']) !!}
    </div>
</div>
<h2>{!! trans('general.dinner_company') !!}</h2>
<div class="row">
    <div class="form-group col-sm-6">
        <label for="add_more_partners">{!! trans('general.dinner_company_adults') !!}</label><br/>
        <p style="font-style: italic">{!! trans('general.dinner_company_adults_subtitle') !!}</p>
        <button id="add_more_partners" class="btn btn-xs btn-info">{!! trans('general.add_adult') !!}</button>
        @include('partials.partners_input')
    </div>
    <div class="form-group col-sm-6">
        <label for="add_more_partners">{!! trans('general.dinner_company_children') !!}</label><br/>
        <p style="font-style: italic">{!! trans('general.dinner_company_children_subtitle') !!}</p>
        <button id="add_more_children" style="margin-left: 5px" class="btn btn-xs btn-success">{!! trans('general.add_child') !!}</button>
        @include('partials.children_input')
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(function(){
        $('#language_proficiency').change();
        $('#referrer').change();
    });

    $('#language_proficiency').change(function(){
        if ($(this).val() == '0') {
            $('.visible-if-not-fluent').show();
        }
        else {
            $('.visible-if-not-fluent').hide();
        }
    }) ;

    $('#referrer').change(function(){
        var selected = $("#referrer option:selected").val(); // Get value from dropdown
        var referrers_containing_friend = {!! json_encode(array_filter($referrers, function($ref){
			return strpos(mb_strtolower($ref), 'vän');
		})) !!}; // Create array of referrers containing "vän"


        if (selected in referrers_containing_friend) { // Show or hide depending on the above
            $('.visible_if_referred_by_friend').show();
        }
        else {
            $('.visible_if_referred_by_friend').hide();
        }
    });


</script>

@endpush