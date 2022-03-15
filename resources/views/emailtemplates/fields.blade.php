<!--- User Id Field --->
<div class="form-group col-sm-12">
    {!! Form::label('email_type', 'Typ av email:') !!}
        @if (!isset($emailTemplate))
            {!! Form::select('email_type', config('constants.emailTypes'), null, ['id' => 'email_type', 'class' => 'form-control input-append']) !!}
        @else
            <h4>{!! config('constants.emailTypes')[$emailTemplate->email_type] !!}</h4>
        @endif
</div>
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Emailtitel') !!}
    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control input-append']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('paragraph1', 'Paragraf 1') !!}
    {!! Form::textarea('paragraph1', null, ['id' => 'paragraph_1', 'rows' => '3', 'class' => 'form-control input-append']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('paragraph2', 'Paragraf 2') !!}
    {!! Form::textarea('paragraph2', null, ['id' => 'paragraph_2', 'rows' => '3', 'class' => 'form-control input-append']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('paragraph3', 'Paragraf 3 (ej obligatorisk)') !!}
    {!! Form::textarea('paragraph3', null, ['id' => 'paragraph_3', 'rows' => '3', 'class' => 'form-control input-append']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('signature', 'Signatur (det som syns nedanför avsändarens namn)') !!}
    {!! Form::textarea('signature', null, ['id' => 'signature', 'rows' => '3', 'class' => 'form-control input-append']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
</div>


@push('scripts')
    <script type="text/javascript">

        $("form").submit(function(){
            // We need to send also data from disabled fields
            $("form :disabled").removeAttr('disabled');
        });


        // Pull in emaildefaults to javascript
        var emailDefaults = [];
        @foreach(config('constants.emailTemplateDefaults') as $emailDefault)
            emailDefaults.push({!! json_encode($emailDefault) !!});
        @endforeach

        $(document).ready(function(){
            disableOrEnableFields();
        });

        $('#email_type').on('change', function(){
            disableOrEnableFields();
            populateWithDefaults();
        });

        function populateWithDefaults() {
            var emailType = $('#email_type').val();
            console.log(emailType);
            var def = emailDefaults.filter(function(d){
                return d.id == emailType;
            })[0];
            $('#title').val(def.title);
            $('#paragraph_1').val(def.paragraph1);
            $('#paragraph_2').val(def.paragraph2);
            $('#paragraph_3').val(def.paragraph3);
            $('#signature').val(def.signature);
        }
        function disableOrEnableFields(){
            $('#paragraph_1').prop('disabled', false);
            $('#paragraph_1').attr('placeholder', '');
            $('#paragraph_2').prop('disabled', false);
            $('#paragraph_2').attr('placeholder', '');

            if($('#email_type').val() == '3'){
                $('#paragraph_1').prop('disabled', true);
                $('#paragraph_1').attr('placeholder', 'Reserverat för beskrivning av gästen')
            }
            else if ($('#email_type').val() == '4'){
                $('#paragraph_2').prop('disabled', true);
                $('#paragraph_2').attr('placeholder', 'Reserverat för länk till datum-val för middag')
            }
        }
    </script>
@endpush