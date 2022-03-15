<table class="table">
    <thead>
    <th>Id</th>
			<th>User Id</th>
			<th>Day Id</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($datepreferences as $datepreference)
        <tr>
            <td>{!! $datepreference->id !!}</td>
			<td>{!! $datepreference->user_id !!}</td>
			<td>{!! $datepreference->day_id !!}</td>
			<td>{!! $datepreference->created_at !!}</td>
			<td>{!! $datepreference->updated_at !!}</td>
            <td>
                <a href="{!! route('datepreferences.edit', [$datepreference->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('datepreferences.delete', [$datepreference->id]) !!}" onclick="return confirm('Are you sure wants to delete this Datepreference?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
