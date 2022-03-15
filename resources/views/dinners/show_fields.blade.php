<table class="table">
    <thead>
    <tr>
        <th>{{ trans('general.date') }}</th>
        <th>{{ trans('general.host') }}</th>
        <th>{{ trans('general.phone') }}</th>
        <th>{{ trans('general.address') }}</th>
        <th>{{ trans('general.adults') }}</th>
        <th>{{ trans('general.children') }}</th>
        <th>{{ trans('general.guests') }}</th>
        <th>{{ trans('general.preferences_hosting_short') }}</th>
        <th>{{ trans('general.other_information') }}</th>
        <th>{{ trans('general.edit') }}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            {{ date('l d-M', strtotime($dinner->date)) }}
        </td>
        <td>
            <a href="{{ route('app.users.show', [$dinner->user->id]) }}">
                {{ $dinner->user->getFullName() }}
                <i class="glyphicon glyphicon-search"></i>
            </a>
        </td>
        <td>{{ $dinner->user->phone }}</td>
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
            @foreach($dinner->children()->get() as $child)
                <label class="label label-default">{{ $child->age }}</label>
            @endforeach
        </td>
        <td>{{ config('constants.DINNER_GUEST_CAPACITY')[config('app.locale')][$dinner->guests] }}</td>
        <td>
            @foreach($dinner->user->getHostingPreferences() as $preference)
                <label style="margin-right: 3px" class="label label-default">
                    {{ $preference->name_hosting }}
                </label>
            @endforeach
        </td>
        <td>
            {{ $dinner->other_info }}
        </td>
        <td>
            <a href="{{ route('app.dinners.edit', [$dinner->id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
            @if($dinner->getStatus() == 'active')
                <a href="{{ route('app.dinners.cancel', [$dinner->id]) }}"><i class="glyphicon glyphicon-ban-circle"></i></a>
            @elseif($dinner->getStatus() == 'inactive')
                <a href="{{ route('app.dinners.activate', [$dinner->id]) }}" class="btn btn-xs btn-success">{{ trans('general.activate') }}</a>
            @endif
            <a href="{{ route('app.dinners.delete', [$dinner->id]) }}" onclick="return confirm('Are you sure wants to delete this Dinner?')"><i class="glyphicon glyphicon-remove"></i></a>
        </td>
    </tr>
    </tbody>
</table>