<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    @if (isset($content))
        {!! isset($content->skip_nl2br) && $content->skip_nl2br ? $content : nl2br($content) !!}
    @else
        @yield('email_content')
    @endif
</body>
</html>