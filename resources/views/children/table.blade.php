<table class="table">
    <thead>
    <th>Id</th>
			<th>Age</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>User Id</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($children as $child)
        <tr>
            <td>{!! $child->id !!}</td>
			<td>{!! $child->age !!}</td>
			<td>{!! $child->created_at !!}</td>
			<td>{!! $child->updated_at !!}</td>
			<td>{!! $child->user_id !!}</td>
            <td>
                <a href="{!! route('app.children.edit', [$child->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.children.delete', [$child->id]) !!}" onclick="return confirm('Are you sure wants to delete this Child?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
