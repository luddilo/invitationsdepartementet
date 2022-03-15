<table id="table" class="table">
    <thead>
        <tr>
            <th>
                <a href="{{ url()->current() }}?column=date&order={{ $newSortOrder or 'asc'}}">
                    {{ trans('general.date') }}
                </a>
            </th>
            <th>{{ trans('general.host') }}</th>
            <th>{{ trans('general.address.city') }}</th>
            <th>{{ trans('general.adults') }}</th>
            <th>{{ trans('general.children') }}</th>
            <th>{{ trans('general.guests') }}</th>
            <th>
                <a href="{{ url()->current() }}?column=created_at&order={{ $newSortOrder or 'asc' }}">
                    {{ trans('general.created_at') }}
                </a>
            </th>
            <th>{{ trans('general.edit') }}</th>
            <th>{{ trans('general.actions') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($dinners as $dinner)
        <tr>
			<td>
                <span style='
                    @if(!$dinner->has_match && \Carbon::parse($dinner->date) < \Carbon::now())
                        {!! 'color: red' !!}
                    @endif
                    '>
                    {{ date('d M', strtotime($dinner->date)) }}
                </span>
            </td>
			<td>
                <a href="{!! route('app.users.show', [$dinner->user->id]) !!}">
                    {{ $dinner->user->getFullName() }}
                </a>
            </td>
			<td>
				{{ $dinner->getAddressCityAttribute() }}
			</td>
            <td>
                <label class="label label-gender-{{ $dinner->user->getGender() }}">{{ $dinner->user->getGender() }}</label>
                @foreach($dinner->partners as $partner)
                    <label class="label label-gender-{{ $partner->getGender() }}">{{ $partner->getGender() }}</label>
                @endforeach
            </td>
            <td>
                @foreach($dinner->children as $child)
                    <label class="label label-default">{{ $child->age }}</label>
                @endforeach
            </td>
            <td>{{ config('constants.DINNER_GUEST_CAPACITY')[config('app.locale')][$dinner->guests] }}</td>
			<td>{{ date('d M Y', strtotime($dinner->created_at)) }}</td>
            <td>
                <a href="{{ route('app.dinners.edit', [$dinner->id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{{ route('app.dinners.cancel', [$dinner->id]) }}"><i class="glyphicon glyphicon-ban-circle"></i></a>
                <a href="{{ route('app.dinners.delete', [$dinner->id]) }}" onclick="return confirm('Are you sure wants to delete this Dinner?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
                <td>
                    @if($dinner->getStatus() == 'active')
                        <a href="{{ route('app.dinners.show', [$dinner->id]) }}" class="btn btn-xs btn-success">{{ trans('general.find_matches') }}</a>
                    @elseif($dinner->getStatus() == 'has_match' || $dinner->getStatus() == 'host_informed')
                        <a href="{{ route('app.dinners.show', [$dinner->id]) }}" class="btn btn-xs btn-success">{{ trans('general.show_dinner') }}</a>
                    @elseif($dinner->getStatus() == 'cancelled')
                        <a href="{{ route('app.dinners.activate', [$dinner->id]) }}" class="btn btn-xs btn-success">{{ trans('general.activate') }}</a>
                    @endif
                </td>

        </tr>
    @endforeach
    </tbody>
</table>
