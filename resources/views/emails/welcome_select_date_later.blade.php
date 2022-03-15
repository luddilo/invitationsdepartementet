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
    Hej {!! $user->first_name !!}!
</p>
<p>
    Vad roligt att du vill bjuda på middag!
</p>
<p>
    När du hittat ett datum som passar kan du boka in dig som middagsvärd i vår kalender <a href="{!! route('dateselection', $user->uuid) !!}">här.</a>.
</p>

<p>
    Har du några frågor är det bara att höra av dig.
</p>

<p>Varma hälsningar,<br>
Lina</p>

--<br/>
<br/>
Lina Makso<br/>
070-075 27 78<br/>
<br/>
<a href="http://www.invitationsdepartementet.se">Invitationsdepartementet</a> // <a href="http://www.unitedinvitations.se">United Invitations</a><br/>
Verkar för nya middagssällskap och minnesvärda måltider.<br/>
<a href="http://www.nytimes.com/2014/07/31/world/europe/in-sweden-dinners-melt-cultural-barriers.html?_r=0">New York Times</a> -
<a href="http://www.stockholmdirekt.se/nyheter/middag-med-gott-samtal-pa-menyn/LdeneD!r3kA8yYFgz4Gzv3VjmhI0Q/">Södermalmsnytt</a> -
<a href="http://www.zeit.de/2014/53/weihnachten-wunder-fluechtlinge-fussball">Die ZEIT</a>

</body>
</html>