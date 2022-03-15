<table class="table">
    <thead>
    <th>Id</th>
			<th>Street</th>
			<th>Zipcode</th>
			<th>City</th>
			<th>Country</th>
			<th>Coord X</th>
			<th>Coord Y</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($addresses as $address)
        <tr>
            <td>{!! $address->id !!}</td>
			<td>{!! $address->street !!}</td>
			<td>{!! $address->zipcode !!}</td>
			<td>{!! $address->city !!}</td>
			<td>{!! $address->country !!}</td>
			<td>{!! $address->coord_x !!}</td>
			<td>{!! $address->coord_y !!}</td>
			<td>{!! $address->created_at !!}</td>
			<td>{!! $address->updated_at !!}</td>
            <td>
                <a href="{!! route('app.addresses.edit', [$address->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.addresses.delete', [$address->id]) !!}" onclick="return confirm('Are you sure wants to delete this Address?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
