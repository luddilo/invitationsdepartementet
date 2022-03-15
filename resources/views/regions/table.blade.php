<table class="table">
    <thead>
        <th>{!! trans('general.name') !!}</th>
        <th>{!! trans('general.email') !!}</th>
        <th>{!! trans('general.responsible_ambassador') !!}</th>
        <th>Minsta framförhållning middag (dagar)</th>
        <th>Användare kan välja datum</th>
        <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($regions as $region)
        <tr>
			<td>{!! $region->name !!}</td>
            <td>{!! $region->email !!}</td>
			<td>{!! !is_null($region->responsible_user) ? $region->responsible_user->getFullName() : '' !!}</td>
            <td>{!! $region->minimum_days_notice_dinner !!}</td>
            <td>
                {!! $region->user_dateselection ? 'Ja' : 'Nej' !!}
            </td>
            <td>
                <a href="{!! route('app.regions.edit', [$region->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.regions.delete', [$region->id]) !!}" onclick="return confirm('Are you sure wants to delete this Region?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
