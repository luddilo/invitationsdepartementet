<table class="table">
    <thead>
            <th>Id</th>
            <th>Name</th>
			<th>Description</th>
            <th>Bootstrap label class</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($statuses as $status)
        <tr>
            <td>{!! $status->id !!}</td>
            <td>{!! $status->name !!}</td>
            <td>{!! $status->description !!}</td>
            <td>{!! $status->bootstrap_label_class !!}</td>
            <td>
                <a href="{!! route('app.statuses.edit', [$status->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.statuses.delete', [$status->id]) !!}" onclick="return confirm('Are you sure wants to delete this Status?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
