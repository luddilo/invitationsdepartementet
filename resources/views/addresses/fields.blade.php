<!--<div class="col-sm-12">
    <div class="form-group col-sm-6">
         Form::label('address_street', 'Streetname and number:') !!}
         Form::text('address_street', isset($address) ? $address->street : null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
         Form::label('address_zip', 'Zipcode:') !!}
         Form::text('address_zip', isset($address) ? $address->zipcode : null, ['class' => 'form-control']) !!}
    </div>
-->
    <div class="form-group col-sm-6">
        {!! Form::label('address_city', trans('general.address.city')) !!}
        {!! Form::text('address_city', isset($address) ? $address->city : null, ['class' => 'form-control']) !!}
    </div>
<!--</div>-->