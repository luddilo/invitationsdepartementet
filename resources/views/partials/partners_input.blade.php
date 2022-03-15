<div id="new_partners_container">
    @if (isset($partners) and count($partners) > 0)

        @foreach($partners as $index => $partner)
            <div class="row partner">
                <div class="col-md-12">
                    <div style="margin-top: 5px; margin-bottom: 5px" class="partner form-inline">
                        {!! Form::label('partner_gender[' . $index . ']', trans('general.gender_select'), ['id' => 'partner_gender_label[' . $index . ']', 'style' => 'margin-right: 10px', 'class' => 'partner_gender_label']) !!}
                        {!! Form::select('partner_gender[' . $index . ']', Config::get('constants.GENDERS')[Config::get('app.locale')], $partner, ['id' => 'partner_gender[' . $index .']', 'class' => 'partner_gender form-control']) !!}
                        <a style="margin-left: 5px" class="remove_input" href><i class="glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>