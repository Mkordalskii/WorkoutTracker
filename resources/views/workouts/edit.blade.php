@extends('main')

@section('title', 'Edytuj trening')

@section('header')
    <h1>Edytuj trening</h1>
@endsection

@section('content')

    <form action="{{ route('workouts.update', $workout->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa treningu</label>

            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ old('name', $workout->name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="training_date" class="form-label">Data treningu</label>

            <input type="date"
                   name="training_date"
                   id="training_date"
                   class="form-control"
                   value="{{ old('training_date', $workout->training_date->format('Y-m-d')) }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notatki</label>

            <textarea name="notes"
                      id="notes"
                      class="form-control"
                      rows="4">{{ old('notes', $workout->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Zapisz zmiany
        </button>

        <a href="{{ route('workouts.index') }}" class="btn btn-secondary">
            Wróć
        </a>
    </form>

@endsection