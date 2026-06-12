@extends('main')

@section('title', 'Dodaj ćwiczenie do treningu')

@section('header')
    <h1>Dodaj ćwiczenie do treningu: {{ $workout->name }}</h1>
@endsection

@section('content')

    <form action="{{ route('workout-exercises.store', $workout->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="exercise_id" class="form-label">Ćwiczenie</label>

            <select name="exercise_id" id="exercise_id" class="form-select" required>
                <option value="">-- wybierz ćwiczenie --</option>

                @foreach($exercises as $exercise)
                    <option value="{{ $exercise->id }}"
                        {{ old('exercise_id') == $exercise->id ? 'selected' : '' }}>
                        {{ $exercise->name }}
                        @if($exercise->muscleGroup)
                            — {{ $exercise->muscleGroup->name }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="planned_sets" class="form-label">Serie</label>
                <input type="number"
                       name="planned_sets"
                       id="planned_sets"
                       class="form-control"
                       value="{{ old('planned_sets', 3) }}"
                       min="1"
                       required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="planned_reps" class="form-label">Powtórzenia</label>
                <input type="number"
                       name="planned_reps"
                       id="planned_reps"
                       class="form-control"
                       value="{{ old('planned_reps', 10) }}"
                       min="1"
                       required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="planned_weight" class="form-label">Ciężar</label>
                <input type="number"
                       step="0.01"
                       name="planned_weight"
                       id="planned_weight"
                       class="form-control"
                       value="{{ old('planned_weight') }}"
                       min="0">
            </div>

            <div class="col-md-3 mb-3">
                <label for="order_number" class="form-label">Kolejność</label>
                <input type="number"
                       name="order_number"
                       id="order_number"
                       class="form-control"
                       value="{{ old('order_number', 1) }}"
                       min="1">
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notatki</label>

            <textarea name="notes"
                      id="notes"
                      class="form-control"
                      rows="4">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Dodaj ćwiczenie
        </button>

        <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-secondary">
            Wróć
        </a>
    </form>

@endsection