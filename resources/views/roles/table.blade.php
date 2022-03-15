<table class="table">
    <thead>
    <th>Id</th>
			<th>Name</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{!! $role->id !!}</td>
			<td>{!! $role->name !!}</td>
			<td>{!! $role->created_at !!}</td>
			<td>{!! $role->updated_at !!}</td>
            <td>
                <a href="{!! route('app.roles.edit', [$role->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.roles.delete', [$role->id]) !!}" onclick="return confirm('Are you sure wants to delete this Role?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
