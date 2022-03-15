<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{!! trans('general.add_note_for') . ' ' . $match->user->getFullName() !!}</h4>
</div>
<div class="modal-body">
    {!! Form::model($match, ['route' => ['app.matches.update', $match->id], 'method' => 'patch']) !!}

        @include('notes.fields')

    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    @if(count($match->user->notes) > 0)
        <h4 style="margin-top: 25px">Tidigare noteringar</h4>
        @include('notes.table', ['notes' => $match->user->notes])
    @endif
</div>