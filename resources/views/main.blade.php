<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        @yield('title', 'Workout Tracker')
    </title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        body {
            background-color: #f5f7fa;
        }

        .page-wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 700;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('muscle-groups.index') }}">
                Workout Tracker
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a href="{{ route('muscle-groups.index') }}" class="nav-link">
                            Grupy mięśniowe
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('exercises.index') }}" class="nav-link">
                            Ćwiczenia
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('workouts.index') }}" class="nav-link">
                            Treningi
                        </a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link">
                            {{ auth()->user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf

                            <button type="submit" class="btn btn-outline-light btn-sm ms-2">
                                Wyloguj
                            </button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            Logowanie
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            Rejestracja
                        </a>
                    </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <main class="container page-wrapper">
        <div class="page-card">

            @yield('header')

            <hr>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <strong>Popraw błędy w formularzu:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')

        </div>
    </main>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>