<table class="table">
    <thead>
        <th>{!! trans('general.preference_guesting') !!}</th>
        <th>{!! trans('general.preference_hosting') !!}</th>
        <th width="50px">{!! trans('general.actions') !!}</th>
    </thead>
    <tbody>
    @foreach($preferences as $preference)
        <tr>
			<td>{!! $preference->name_guesting !!}</td>
            <td>{!! $preference->name_hosting !!}</td>
            <td>
                <a href="{!! route('app.preferences.edit', [$preference->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.preferences.delete', [$preference->id]) !!}" onclick="return confirm('Are you sure wants to delete this Preference?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
