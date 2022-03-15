<table class="table">
    <thead>
        <th>{!! trans('general.note') !!}</th>
        <th>{!! trans('general.author') !!}</th>
        <th>{!! trans('general.created_at') !!}</th>
        <th>{!! trans('general.actions') !!}</th>
    </thead>
    <tbody>
    @foreach($notes->reverse() as $note)
        <tr>
			<td>{!! $note->content !!}</td>
			<td>{!! $note->author->getFullName() !!}</td>
			<td>{!! date('d-M H:i', strtotime($note->created_at)) !!}</td>
            <td>
                <a href="{!! route('app.notes.delete', [$note->id]) !!}" onclick="return confirm('Are you sure wants to delete this Note?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
