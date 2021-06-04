<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>SVG帳票サンプル</title>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <div class="container-sm">
        <a class="navbar-brand" href="{{ url('/') }}">SVG帳票サンプル</a>
    </div>
</nav>

<div id="content" class="bg-white" style="padding-top:55px">
    <div class="container-sm d-flex justify-content-center align-items-center" style="height:70vh">
        <div class="card p-5">
            <div class="card-body d-flex">
                <a class="btn btn-link" href="{{ url('/print/estimate/見積書（金額あり）') }}" target="_blank"><i class="fa fa-print"></i> 見積書（金額あり）</a></li>
                <a class="btn btn-link" href="{{ url('/print/estimate/見積書（金額なし）') }}" target="_blank"><i class="fa fa-print"></i> 見積書（金額なし）</a></li>
            </div>
        </div>
    </div>
</div>

<footer id="footer" class="container-sm">
    <div class="small text-muted text-end py-3">
        <a href="https://twitter.com/ttskch" target="_blank" class="text-muted"><b>ttskch</b></a> &copy; {{ (new DateTime('now'))->format('Y') }} / <a href="https://github.com/ttskch/svg-paper-example" target="_blank" class="text-muted"><i class="fab fa-github"></i></a>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
