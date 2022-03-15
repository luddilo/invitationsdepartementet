<table class="table">
    <thead>
        <th>{!! trans('general.name') !!}</th>
        <th>{!! trans('general.phone') !!}</th>
        <th>{!! trans('general.address') !!}</th>
        <th style="min-width: 75px">{!! trans('general.adults') !!}</th>
        <th>{!! trans('general.children') !!}</th>
        <th>{!! trans('general.preferences') !!}</th>
        <th>{!! trans('general.notes') !!}</th>
        <th>{!! trans('general.history') !!}</th>
        <th>{!! trans('general.score') !!}</th>
        <th>{!! trans('general.status') !!}</th>
        <th width="150px">{!! trans('general.actions') !!}</th>
    </thead>
    <tbody>
    @foreach($matches as $match)
        <tr>
            <td>
                <a href="{!! route('app.users.show', [$match->user->id]) !!}">
                    {!! $match->user->getFullName() !!}
                </a>
            </td>
            <td>{!! $match->user->phone !!}</td>
            <td>
                {!! $match->user->getAddressCityAttribute() !!}
            </td>
			<td>
                <label class="label label-gender-{!! $match->user->getGender() !!}">{!! $match->user->getGender() !!}</label>
                @foreach($match->user->partners as $partner)
                    <label class="label label-gender-{!! $partner->getGender() !!}">{!! $partner->getGender() !!}</label>
                @endforeach
            </td>
			<td>
                @foreach($match->user->children as $child)
                    <label class="label label-default">{!! $child->age !!}</label>
                @endforeach
            </td>
            <td>
                @foreach($match->user->getGuestingPreferences() as $preference)
                    <label class="label label-default">{!! $preference->name_guesting !!}</label>
                @endforeach
            </td>
            <td>
                @if(count($match->user->notes) > 0)
                    {!! $match->user->notes->reverse()->first()->content !!}
                @endif
                <a href role="button" class="open-modal" data-toggle="modal" data-target="#modal-notes-{!! $match->id !!}">
                    <i class="fa fa-comment"></i>
                </a>
            </td>
            <td>
                {!! $match->user->getStatusName() !!}
            </td>
            <td>
                <!--<button data-toggle="popover" title="Poängnedbrytning" data-trigger="focus" data-content="
                {!
                    $match->dinner->children_score
                !!}">-->
                {!! $match->match_score !!} %
            </td>
            <td>
                <label class="label {!! $match->getStatusCssClass() !!}">
                    {!! $match->status !!}
                </label>
            </td>
            <td style="font-size: 14px">
                @if($match->getStatus() != 2)
                    <a href="{!! route('app.matches.approve', $match->id) !!}">
                        <i class="fa fa-check-square-o"></i>
                    </a>
                @endif
                <a href role="button" class="open-modal" data-toggle="modal" data-target="#modal-deny-{!! $match->id !!}">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
                <a href="{!! route('app.users.matches', $match->user->id) !!}">
                    <i class="fa fa-calendar"></i>
                </a>
                <a href="{!! route('app.users.edit', $match->user->id) !!}">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@foreach ($matches as $match)
    @include('partials.modal', ['content' => 'matches.notes', 'modalName' => 'notes-' . $match->id])
    @include('partials.modal', ['content' => 'matches.deny', 'modalName' => 'deny-' . $match->id])
@endforeach

@push('scripts')
    <script type="text/javascript">
        /*$(function(){
            $('[data-toggle="popover"]').popover();
        });*/
    </script>

@endpush