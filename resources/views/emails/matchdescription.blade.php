Hoppas du mår bra! På {!! $dinner->getPrettyDate() !!} så kommer
{!! $guest->getFullName() !!} från
{!! $guest->nationality !!} gärna på middag hos er.

@if(count($guest->partners) + count($guest->children) > 0)
    {!! $guest->first_name !!} tar med sig

    @if(count($guest->partners) > 0)
        @if(count($guest->partners) == 1)
            en vuxen (
        @else
            {!! count($guest->partners) . ' vuxna (' !!}

        @endif

        @foreach($guest->partners as $index => $partner)
            {!! strtolower($partner->getGender()) !!}
            @if($index != count($guest->partners) -1)
                ,
            @endif
        @endforeach
        )

        @if(count($guest->children) > 0)
            och
        @else
            .
        @endif
    @endif

    @if(count($guest->children) > 0)
        @if(count($guest->children) == 1)
            sitt barn
        @else
            sina {!! count($guest->children) !!} barn
        @endif

        (ålder
        @foreach($guest->children as $index => $child)
            {!! $child->age !!}
            @if($index != count($guest->children) -1)
            ,
            @endif
        @endforeach
        ).
    @endif
@endif

@if(count($guest->preferences) > 0)
    {!! $guest->first_name !!} är allergisk mot/äter inte:
    @foreach($guest->preferences as $index => $preference)
        {!! mb_strtolower($preference->name_guesting) !!}
        @if($index != count($guest->preferences) -1)
            ,
        @endif
    @endforeach
    .
@else
    De äter allt.
@endif
{!! $guest->gender == 'F' ? 'Hon' : 'Han' !!}

@if($guest->school_id != 0)
    läser svenska på
    {!! $guest->school->name !!}
    och
@endif
har telefonnummer {!! $guest->phone !!}.