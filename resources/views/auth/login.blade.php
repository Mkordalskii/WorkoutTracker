@extends('main')

@section('title', 'Logowanie')

@section('header')
    <h1>Logowanie</h1>
@endsection

@section('content')

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Adres e-mail</label>

            <input type="email"
                   name="email"
                   id="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Hasło</label>

            <input type="password"
                   name="password"
                   id="password"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Zaloguj
        </button>

        <a href="{{ route('register') }}" class="btn btn-link">
            Nie masz konta? Zarejestruj się
        </a>
    </form>

@endsection