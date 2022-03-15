<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<p>
    Hej,
</p>

<p>
    Någon har begärt att nollställa ditt lösenord. Är det inte du? Bortse då från detta mail.
</p>

<p>
    Följ denna länk för att välja ett nytt lösenord: <a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>
</p>

<p>Hälsningar,<br>
    Invitationsdepartementet</p>

</body>
</html>