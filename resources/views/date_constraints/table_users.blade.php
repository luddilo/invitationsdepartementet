<table class="table">
    <thead>
			<th>Från</th>
			<th>Till</th>
            <th>Meddelande</th>
			<th>Skapad av</th>
            <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($date_constraints as $date_constraint)
        <tr>
			<td>{!! $date_constraint->from !!}</td>
			<td>{!! $date_constraint->to !!}</td>
            <td>{!! $date_constraint->message !!}</td>
			<td>{!! !is_null(App\Models\User::find($date_constraint->created_by)) ? App\Models\User::find($date_constraint->created_by)->getFullName() : '' !!}</td>
            <td>
                <a href="{!! route('app.date_constraints.delete', [$date_constraint->id]) !!}" onclick="return confirm('Are you sure wants to delete this date_constraint?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
