<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- So that mobile will display zoomed in -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- enable media queries for windows phone 8 -->
    <meta name="format-detection" content="telephone=no">
    <!-- disable auto telephone linking in iOS -->
</head>
<body>
<p>
    Hej {!! $user->first_name . '!' !!}
</p>

<p>
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
            {!! strtolower($preference->name_guesting) !!}
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

</p>

<p>
    Vänligen skicka ett Välkommen på middag-sms på svenska till {!! $guest->first_name !!} med er adress, ev. kod, våning, namn på dörren och närmsta hållplats, samt tid och dag (som påminnelse). Standardtid för middagar är 18.30. Om du föredrar en annan tid skriver du det i sms:et. Det är viktigt att ni etablerar kontakt med varandra, om du inte får tag på din gäst - hör av dig till oss.
</p>
<p>
    Möten mellan människor kan vara både enkelt och komplicerat. Du är alltid är välkommen att höra av dig till mig om ditt möte av någon anledning inte blev som det var tänkt. Det är viktig information för oss och vår verksamhet och som vi gärna vill följa upp.
</p>
<p>
    Önskar er en trevlig kväll och låt mig veta om du har några frågor.
</p>

<p>
    Tack för att ni bjuder på middag!
</p>
<p>
    Varma hälsningar,
</p>
<p>
    {!! $sender->getFullName() !!},<br>
    Invitationsdepartementet
</p>

<p> P.S.
    Om ni önskar, dela gärna en bild från middagsbordet, med alla närvarandes samtycke, på facebooksidan eller instagram #invitationsdepartementet. Har du funnit en ny bekantskap är det bara att hålla kontakten, om inte hoppas vi att ni iallafall fick en minnesvärd måltid och du är varmt välkommen att bjuda på middag igen.
</p>
</body>
</html>