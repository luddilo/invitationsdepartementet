<div class="col-md-12">
    @if (isset($canPreviewFeedback) && $canPreviewFeedback)
        <a class="btn btn-primary pull-right"
           style="margin-top: 25px; margin-bottom: 10px; margin-left: 10px;"
           href="{!! route('app.matches.preview_email', [$dinner->acceptedMatch()->id, 7]) !!}">
            {{ trans('email.preview_feedback_host') }}
        </a>
    @endif

    @if($dinner->hasAcceptedMatch() && !$dinner->hasInformedHost())
        <a class="btn btn-success pull-right"
           style="margin-top: 25px; margin-bottom: 10px"
           href="{!! route('app.matches.preview_email', [$dinner->acceptedMatch()->id]) !!}">
            {!! trans('general.send_email')!!}
        </a>
    @endif


    @if($matches->isEmpty())
        <h2>{!! trans('general.find_a_match') !!}</h2>
        {!! Form::select('user_id', $users, null, ['id' => 'user_select', 'style' => 'height: 35px', 'class' => 'col-md-3']) !!}
            <a class="btn btn-primary" id="manual_selection" href>
                {!! trans('general.select')!!}
            </a>
        <span style="padding-left: 50px; padding-right: 50px">eller</span>
        <a class="btn btn-primary" href="{!! route('app.dinners.matches.refresh', [$dinner->id]) !!}">{!! trans('general.find_automatically')!!}</a>
    @else
        @if(!$dinner->hasAcceptedMatch())
            <div style="padding-top: 20px">
                <a class="btn btn-primary pull-right" href="{!! route('app.dinners.matches.refresh', [$dinner->id]) !!}">
                    {!! trans('general.refresh_matches')!!}
                </a>
                <span class="pull-right" style="padding-left: 50px; padding-right: 50px">eller</span>
                <div class="pull-right">
                    {!! Form::select('user_id', $users, null, ['id' => 'user_select', 'style' => 'height: 35px']) !!}
                    <a class="btn btn-primary" id="manual_selection" href>
                        {!! trans('general.select')!!}
                    </a>
                </div>
            </div>

        @endif
        <h2 class="pull-left">{!! trans('general.matches') !!}</h2>
        @include('matches.table')
    @endif
</div>

@push('scripts')
    <script type="text/javascript">
        $('#user_select').select2();
    </script>
    <script type="text/javascript">
        $('#manual_selection').click(function(e){
            e.preventDefault();
            if ($('#user_select').val() != ''){
                var url = '{!! route('app.matches.create_and_approve', [$dinner->id, 'existing_user']) !!}';
                url = url.replace('existing_user', $('#user_select').val());
                //$('#existing_user').attr('href', url);
                //$('#existing_user').removeAttr('disabled');
                window.location = url;
            }
        });
    </script>
@endpush