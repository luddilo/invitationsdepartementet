<table class="table">
    <thead>
    <th>Id</th>
			<th>Gender</th>
			<th>Type</th>
			<th>Partnerable Id</th>
			<th>Partnerable Type</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($partners as $partner)
        <tr>
            <td>{!! $partner->id !!}</td>
			<td>{!! $partner->gender !!}</td>
			<td>{!! $partner->type !!}</td>
			<td>{!! $partner->partnerable_id !!}</td>
			<td>{!! $partner->partnerable_type !!}</td>
			<td>{!! $partner->created_at !!}</td>
			<td>{!! $partner->updated_at !!}</td>
            <td>
                <a href="{!! route('partners.edit', [$partner->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('partners.delete', [$partner->id]) !!}" onclick="return confirm('Are you sure wants to delete this Partner?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
