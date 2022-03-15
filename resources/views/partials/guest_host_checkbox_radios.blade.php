@if(Auth::guest())
    <div class="checkbox">
        <label>
            {!! Form::radio('wants_to_host', 1, true, ['id' => 'wants_to_host', 'class' => 'wants_to_host_guest_radio']) !!}
            {!! trans('general.wants_to_host') !!}
        </label>
    </div>
    <div class="checkbox">
        <label>
            {!! Form::radio('wants_to_host', 0, null, ['id' => 'wants_to_guest', 'class' => 'wants_to_host_guest_radio']) !!}
            {!! trans('general.wants_to_guest') !!}
        </label>
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(function(){ // Since we want to do these checks when we load the page
            if ($('#wants_to_guest').attr('checked') == 'checked') {
                $('.visible-if-guesting').show();
                $('.multiple').select2();
                console.log("wants to guest");
            }
            else {
                $('.visible-if-guesting').hide();
            }

            if ($('#wants_to_host').attr('checked') == 'checked') {
                $('.visible-if-hosting').show();
                $('.multiple').select2();
                console.log("wants to host");
            }
            else {
                $('.visible-if-hosting').hide();
            }
        });

        $('.wants_to_host_guest_radio').click(function(){
            if ($(this).val() == 0) {
                $('.visible-if-guesting').show();
                $('.multiple').select2();
                $('.visible-if-hosting').hide();
            }
            else {
                $('.visible-if-guesting').hide();
                $('.visible-if-hosting').show();
                $('.multiple').select2();
            }
        }) ;
    </script>
    @endpush

@else
    <div class="checkbox">
        <label>
            {!! Form::hidden('wants_to_host', 0) !!}
            {!! Form::checkbox('wants_to_host', 1, null, ['id' => 'wants_to_host']) !!}
            {!! trans('general.wants_to_host') !!}
        </label>
    </div>
    <div class="checkbox">
        <label>
            {!! Form::hidden('wants_to_guest', 0) !!}
            {!! Form::checkbox('wants_to_guest', 1, null, ['id' => 'wants_to_guest']) !!}
            {!! trans('general.wants_to_guest') !!}
        </label>
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(function(){ // Since we want to do these checks when we load the page
            if ($('#wants_to_guest').attr('checked') == 'checked') {
                $('.visible-if-guesting').show();
                $('.multiple').select2();
                console.log("wants to guest");
            }
            else {
                $('.visible-if-guesting').hide();
            }

            if ($('#wants_to_host').attr('checked') == 'checked') {
                $('.visible-if-hosting').show();
                $('.multiple').select2();
                console.log("wants to host");
            }
            else {
                $('.visible-if-hosting').hide();
            }
        });

        $('#wants_to_guest').click(function(){
            if (this.checked) {
                $('.visible-if-guesting').show();
                $('.multiple').select2();
            }
            else {
                $('.visible-if-guesting').hide();
            }
        }) ;
        $('#wants_to_host').click(function(){
            if (this.checked) {
                $('.visible-if-hosting').show();
                $('.multiple').select2();
            }
            else {
                $('.visible-if-hosting').hide();
            }
        }) ;
    </script>
    @endpush
@endif

