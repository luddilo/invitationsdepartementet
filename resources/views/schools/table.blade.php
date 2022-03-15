<table class="table">
    <thead>
			<th>{!! trans('general.name') !!}</th>
			<th>{!! trans('general.level') !!}</th>
			<th>{!! trans('general.region') !!}</th>
            <th width="50px">{!! trans('general.actions') !!}</th>
    </thead>
    <tbody>
    @foreach($schools as $school)
        <tr>
			<td>{!! $school->name !!}</td>
			<td>{!! $school->level !!}</td>
			<td>{!! $school->region->name !!}</td>
            <td>
                <a href="{!! route('app.schools.edit', [$school->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.schools.delete', [$school->id]) !!}" onclick="return confirm('Are you sure wants to delete this School?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
