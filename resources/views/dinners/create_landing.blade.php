@extends('layouts.app')

@section('content')
<div class="col-md-12">

    @include('common.errors')

    <h1>{!! trans('general.new_or_existing_user') !!}</h1>

        <a class="btn btn-primary col-md-3" style="margin-bottom: 5px; margin-right: 5px" href="{!! route('app.users.create') !!}">{!! trans('general.new_user') !!}</a>

        {!! Form::select('user_id', $users, null, ['id' => 'user_select', 'style' => 'height: 35px', 'class' => 'col-md-3']) !!}
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#user_select').select2();
    </script>
    <script type="text/javascript">
        $('#user_select').change(function(){
            var url = '{!! route('app.users.dinners.create', 'existing_user') !!}';
            url = url.replace('existing_user', $('#user_select').val());
            //$('#existing_user').attr('href', url);
            //$('#existing_user').removeAttr('disabled');
            window.location = url;
        });
    </script>


@endpush