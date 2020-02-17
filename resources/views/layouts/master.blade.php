<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <script src="{{ mix('/js/app.js') }}"></script>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('person.index') }}">People</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('template.index') }}">Templates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('templatepart.index') }}">Template Parts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        @if(session('message'))
        <div class="alert alert-{{ session('message.type')}}">
            {{ session('message.content') }}
        </div>
        @endif

        @yield('content')
    </div>

    <footer id="footer">
        &copy; LSi Ltd 2020 @if(date('Y') !== '2020') &ndash; date('Y') @endif
    </footer>
</body>
</html>