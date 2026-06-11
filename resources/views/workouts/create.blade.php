@extends('main')

@section('title', 'Dodaj trening')

@section('header')
    <h1>Dodaj trening</h1>
@endsection

@section('content')

    <form action="{{ route('workouts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa treningu</label>

            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   placeholder="Np. Trening Push"
                   required>
        </div>

        <div class="mb-3">
            <label for="training_date" class="form-label">Data treningu</label>

            <input type="date"
                   name="training_date"
                   id="training_date"
                   class="form-control"
                   value="{{ old('training_date', date('Y-m-d')) }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notatki</label>

            <textarea name="notes"
                      id="notes"
                      class="form-control"
                      rows="4"
                      placeholder="Opcjonalne notatki do treningu">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Zapisz
        </button>

        <a href="{{ route('workouts.index') }}" class="btn btn-secondary">
            Wróć
        </a>
    </form>

@endsection