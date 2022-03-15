<table class="table">
    <thead>
        <th>{!! trans('general.date') !!}</th>
        <th>{!! trans('general.name') !!}</th>
        <th>{!! trans('general.address') !!}</th>
        <th style="min-width: 75px">{!! trans('general.adults') !!}</th>
        <th>{!! trans('general.children') !!}</th>
        <th>{!! trans('general.preferences') !!}</th>
        <th>{!! trans('general.notes') !!}</th>
        <th>{!! trans('general.score') !!}</th>
        <th>{!! trans('general.status') !!}</th>
        <th width="150px">{!! trans('general.actions') !!}</th>
    </thead>
    <tbody>
    @foreach($matches as $match)
        <tr>
            <td>
                {!! date('d-M (D)', strtotime($match->dinner->date)) !!}
            </td>
            <td>
                <a href="{!! route('app.users.show', [$match->dinner->user->id]) !!}">
                    {!! $match->dinner->user->getFullName() !!}
                </a>
            </td>
            <td>
                {!! $match->dinner->getAddressCityAttribute() !!}
            </td>
			<td>
                <label class="label label-gender-{!! $match->dinner->user->getGender() !!}">{!! $match->dinner->user->getGender() !!}</label>
                @foreach($match->dinner->partners as $partner)
                    <label class="label label-gender-{!! $partner->getGender() !!}">{!! $partner->getGender() !!}</label>
                @endforeach
            </td>
			<td>
                @foreach($match->dinner->children as $child)
                    <label class="label label-default">{!! $child->age !!}</label>
                @endforeach
            </td>
            <td>
                @foreach($match->dinner->user->getHostingPreferences() as $preference)
                    <label class="label label-default">{!! $preference->name_hosting !!}</label>
                @endforeach
            </td>
            <td>
                {!! $match->dinner->other_info !!}
            </td>
            <td>{!! $match->match_score !!} %</td>
            <td>
                <label class="label {!! $match->getStatusCssClass() !!}">
                    {!! $match->status !!}
                </label>
            </td>
            <td style="font-size: 20px">
                <a href="{!! route('app.matches.approve', $match->id) !!}">
                    <i class="fa fa-check-square-o"></i>
                </a>
                <a href="{!! route('app.matches.deny', $match->id) !!}">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@foreach ($matches as $match)
    @include('partials.modal', ['content' => 'matches.notes', 'modalName' => $match->id])
@endforeach
