<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
    <link rel="stylesheet" href="{{ asset('/css/print.css') }}">
    <title>@section('title')@show</title>
    @section('javascript')@show
</head>
<body>
@section('body')
    @php
        foreach ($replacements as $search => $replacement) {
            $svg = str_replace($search, $replacement, $svg);
        }
        echo $svg;
    @endphp
@show
</body>
</html>
