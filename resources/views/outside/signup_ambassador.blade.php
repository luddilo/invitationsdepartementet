<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{!! trans('general.become_ambassador_cta') !!}</h4>
</div>
<div class="modal-body">
    <p>Vill du bli ambassadör?</p>
    {!! Form::open(['route' => 'app.users.store']) !!}


    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

</div>