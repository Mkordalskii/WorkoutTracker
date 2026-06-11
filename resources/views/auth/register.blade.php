@extends('main')

@section('title', 'Rejestracja')

@section('header')
    <h1>Rejestracja</h1>
@endsection

@section('content')

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Imię / nazwa użytkownika</label>

            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   required>
        </div>

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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Powtórz hasło</label>

            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-success">
            Utwórz konto
        </button>

        <a href="{{ route('login') }}" class="btn btn-link">
            Masz już konto? Zaloguj się
        </a>
    </form>

@endsection