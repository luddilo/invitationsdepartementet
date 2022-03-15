<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 class="modal-title">Neka användaren för denna middag eller inaktivera?</h3>
</div>
<div class="modal-body">
    <h4 class="modal-title"> Neka för denna middag</h4>
    <a class="btn btn-primary" href="{!! route('app.matches.deny', $match->id) !!}">Neka</a>
</div>
<div class="modal-header">
</div>
<div class="modal-body">
    <h4 class="modal-title"> Neka och inaktivera en period</h4>
    {!! Form::open(['route' => 'app.date_constraints.store']) !!}

    @include('date_constraints.fields_user', ['date' => $match->dinner->date, 'user' => $match->user])
    {!! Form::hidden('match_id', $match->id) !!}

    {!! Form::submit("Neka och inaktivera denna period", ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
<div class="modal-header">
</div>
<div class="modal-body">
    <h4 class="modal-title">Neka och inaktivera deltagare</h4>
    <a class="btn btn-primary" href="{!! route('app.users.inactivate', $match->user->id) !!}">Neka och inaktivera deltagare</a>
</div>