<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ config('app.name', 'Laravel') }}
        @yield('title')
    </title>
    <link href="/css/app.css" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!}
    </script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('root.index', []) }}">IS Gamykla</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('gamyklos.index', []) }}">
                    <i class="fas fa-industry my-auto" aria-hidden="true"></i> Gamyklos
                </a>
            </li>
        </ul>
    </nav>

    <div class="body pt-2">
        @yield('content')
    </div>

    <script src="/js/app.js"></script>
</body>

</html>