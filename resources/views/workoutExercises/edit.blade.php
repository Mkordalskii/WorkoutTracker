@extends('main')

@section('title', 'Edytuj ćwiczenie w treningu')

@section('header')
    <h1>Edytuj ćwiczenie w treningu</h1>
@endsection

@section('content')

    <div class="alert alert-secondary">
        <strong>Trening:</strong> {{ $workoutExercise->workout->name }} <br>
        <strong>Ćwiczenie:</strong> {{ $workoutExercise->exercise->name }}
    </div>

    <form action="{{ route('workout-exercises.update', $workoutExercise->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="planned_sets" class="form-label">Serie</label>
                <input type="number"
                       name="planned_sets"
                       id="planned_sets"
                       class="form-control"
                       value="{{ old('planned_sets', $workoutExercise->planned_sets) }}"
                       min="1"
                       required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="planned_reps" class="form-label">Powtórzenia</label>
                <input type="number"
                       name="planned_reps"
                       id="planned_reps"
                       class="form-control"
                       value="{{ old('planned_reps', $workoutExercise->planned_reps) }}"
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
                       value="{{ old('planned_weight', $workoutExercise->planned_weight) }}"
                       min="0">
            </div>

            <div class="col-md-3 mb-3">
                <label for="order_number" class="form-label">Kolejność</label>
                <input type="number"
                       name="order_number"
                       id="order_number"
                       class="form-control"
                       value="{{ old('order_number', $workoutExercise->order_number) }}"
                       min="1">
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notatki</label>

            <textarea name="notes"
                      id="notes"
                      class="form-control"
                      rows="4">{{ old('notes', $workoutExercise->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Zapisz zmiany
        </button>

        <a href="{{ route('workouts.show', $workoutExercise->workout_id) }}" class="btn btn-secondary">
            Wróć
        </a>
    </form>

@endsection