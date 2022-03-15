<div class="row panel">
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('created_at', 'Medlem sedan') !!}:
        <p class="form-control-static">{!! $user->created_at !!}</p>
    </div>
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('region', trans('general.region')) !!}:
        <p class="form-control-static">{!! $user->region->name or '-' !!}</p>
    </div>
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('role_list[]', trans('general.role')) !!}:
        <p class="form-control-static">
            @foreach($user->roles as $role)
                {!! $role->name !!}
            @endforeach
        </p>
    </div>
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('status', trans('general.status')) !!}:
        <p class="form-control-static">
            {!! $user->isActive() ? '<span style="color:green">Aktiv</span>' :
                ($user->activeDateConstraint() ?
                    '<span style="color:red">Inaktiv</span> (' . $user->activeDateConstraint()->from . ' till ' . $user->activeDateConstraint()->to . '): ' . $user->activeDateConstraint()->message :
                     '<span style="color:red">Inaktiv</span>')!!}
        </p>
    </div>
</div>

<h3>{!! trans('general.personal_details') !!}</h3>
<div class="row panel">
    <!--- Age Field --->
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('age', trans('general.age')) !!}:
        <p class="form-control-static">{!! $user->getAge() !!}</p>
    </div>

    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('email', trans('general.email')) !!}:
        <p class="form-control-static">{!! $user->email  !!}</p>
    </div>

    <!--- Phone Field --->
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('phone', trans('general.phone')) !!}:
        <p class="form-control-static">{!! $user->phone !!}</p>
    </div>

    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('street', trans('general.address')) !!}:
        <p class="form-control-static">
            {!! $user->getAddressAttributes() !!}
        </p>
    </div>

    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('nationality', trans('general.nationality')) !!}:
        <p class="form-control-static">{!! $user->nationality !!}</p>
    </div>

    <!--- Gender Field --->
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('gender', trans('general.gender')) !!}:
        <label class="label label-gender-{!! $user->getGender() !!}">
            {!! $user->getGender() !!}
        </label>
    </div>


    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('fluent', trans('general.language_proficiency')) !!}:
        <p class="form-control-static">{!! $user->getLangProficiencyAttribute() !!}</p>
    </div>

    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('school_id', trans('general.school')) !!}:
        <p class="form-control-static">{!! $user->school->name or '' !!}</p>
    </div>
</div>

<h3>{!! trans('general.dinner_preferences') !!}</h3>
<div class="row panel">
    <div class="col-sm-12">
        <div class="form-group col-sm-6">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('wants_to_host', 1, $user->wants_to_host, ['disabled']) !!}
                    {!! trans('general.wants_to_host') !!}
                </label>
            </div>
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('wants_to_guest', 1, $user->wants_to_guest, ['disabled']) !!}
                    {!! trans('general.wants_to_guest') !!}
                </label>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <h4>{!! trans('general.dinner_company') !!}</h4>
            <p class="form-control-static">
            {!! Form::label('partner_gender', trans('general.gender_select'), ['id' => 'partner_gender_label', 'class' => 'partner_gender_label']) !!}:
            @foreach($user->partners as $partner)
                <label class="label label-gender-{!! $partner->getGender() !!}">
                    {!! $partner->getGender() !!}
                </label>
            @endforeach
            </p>
            <p class="form-control-static">
                {!! Form::label('children_age', trans('general.age_select')) !!}:
                @foreach($user->children as $child)
                    <label class="label label-info">
                        {!! $child->age !!}
                    </label>
                @endforeach
            </p>
            @include('partials.children_input')
        </div>
    </div>

    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('preference_list_guesting[]', trans('general.preferences_guesting')) !!}:
            @foreach($user->getGuestingPreferences() as $preference)
                <label class="label label-default">
                    {!! $preference->name_guesting !!}
                </label>
            @endforeach
    </div>
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('preference_list_hosting[]', trans('general.preferences_hosting')) !!}:
        @foreach($user->getHostingPreferences() as $preference)
            <label class="label label-default">
                {!! $preference->name_hosting !!}
            </label>
        @endforeach
    </div>
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('datepreference_list[]', trans('general.date_availability')) !!}:
            @foreach($user->datepreferences as $datepreference)
                <label class="label label-default">
                    {!! Config::get('constants.WEEKDAYS')[Config::get('app.locale')][$datepreference->day_id] !!}
                </label>
            @endforeach
    </div>
    <div class="form-group col-sm-6 form-inline">
        {!! Form::label('other_info', trans('general.other_information')) !!}:
        <p class="form-control-static">{!! $user->other_info or '' !!}</p>
    </div>
    <div class="form-group col-sm-6 form-inline">
        <h4>{!! trans('general.notes') !!}</h4>
        <a class="btn btn-xs btn-primary" style="margin-top: 25px; margin-left: 5px;" href="{!! route('app.users.notes', $user->id) !!}">{!! trans('general.all_notes') !!}</a>
        @foreach($user->notes->reverse() as $note)
            @include('notes.show_fields', ['notes' => $note])
        @endforeach
    </div>
</div>




<!-- https://github.com/ubilabs/geocomplete -->