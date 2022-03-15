<table class="table zebra-striping">
    <thead>
			<th>Name</th>
			<th>Description</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($referrers as $referrer)
        <tr>
			<td>{!! $referrer->name !!}</td>
			<td>{!! $referrer->description !!}</td>
			<td>{!! $referrer->created_at !!}</td>
			<td>{!! $referrer->updated_at !!}</td>
            <td>
                <a href="{!! route('app.referrers.edit', [$referrer->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.referrers.delete', [$referrer->id]) !!}" onclick="return confirm('Are you sure wants to delete this Referrer?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
