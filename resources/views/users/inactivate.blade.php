<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 class="modal-title">Inaktivera för en period eller permanent?</h3>
</div>
<div class="modal-body">
    <h4 class="modal-title"> Inaktivera en period</h4>
    {!! Form::open(['route' => 'app.date_constraints.store']) !!}

    @include('date_constraints.fields_user', ['date' => Carbon::today()->toDateString()] )

    {!! Form::submit("Inaktivera denna period", ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

</div>
<div class="modal-header">
</div>
<div class="modal-body">
    <h4 class="modal-title">Inaktivera permanent</h4>
    <a class="btn btn-primary" href="{!! route('app.users.inactivate', $user->id) !!}">Inaktivera deltagare</a>
</div>