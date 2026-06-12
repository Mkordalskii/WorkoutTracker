@extends('main')

@section('title', 'Zarejestruj wykonanie treningu')

@section('header')
    <h1>Zarejestruj wykonanie treningu: {{ $workout->name }}</h1>
@endsection

@section('content')

    @if($workout->workoutExercises->count() === 0)
        <div class="alert alert-warning">
            Ten trening nie ma przypisanych ćwiczeń. Najpierw dodaj ćwiczenia do treningu.
        </div>

        <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-secondary">
            Wróć
        </a>
    @else

        <form action="{{ route('workout-logs.store', $workout->id) }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="performed_at" class="form-label">Data wykonania</label>
                    <input type="date"
                           name="performed_at"
                           id="performed_at"
                           class="form-control"
                           value="{{ old('performed_at', date('Y-m-d')) }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="duration_minutes" class="form-label">Czas trwania w minutach</label>
                    <input type="number"
                           name="duration_minutes"
                           id="duration_minutes"
                           class="form-control"
                           value="{{ old('duration_minutes') }}"
                           min="1">
                </div>
            </div>

            <div class="mb-4">
                <label for="summary" class="form-label">Podsumowanie treningu</label>
                <textarea name="summary"
                          id="summary"
                          class="form-control"
                          rows="3">{{ old('summary') }}</textarea>
            </div>

            <h4 class="mb-3">Wyniki ćwiczeń</h4>

            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Ćwiczenie</th>
                        <th>Plan</th>
                        <th>Serie</th>
                        <th>Powtórzenia</th>
                        <th>Ciężar</th>
                        <th>Notatki</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($workout->workoutExercises as $index => $item)
                        <tr>
                            <td>
                                {{ $item->exercise->name }}

                                <input type="hidden"
                                       name="exercise_id[]"
                                       value="{{ $item->exercise_id }}">
                            </td>

                            <td>
                                {{ $item->planned_sets }} x {{ $item->planned_reps }}

                                @if($item->planned_weight !== null)
                                    x {{ $item->planned_weight }} kg
                                @endif
                            </td>

                            <td>
                                <input type="number"
                                       name="actual_sets[]"
                                       class="form-control"
                                       value="{{ old('actual_sets.' . $index, $item->planned_sets) }}"
                                       min="1"
                                       required>
                            </td>

                            <td>
                                <input type="number"
                                       name="actual_reps[]"
                                       class="form-control"
                                       value="{{ old('actual_reps.' . $index, $item->planned_reps) }}"
                                       min="1"
                                       required>
                            </td>

                            <td>
                                <input type="number"
                                       step="0.01"
                                       name="actual_weight[]"
                                       class="form-control"
                                       value="{{ old('actual_weight.' . $index, $item->planned_weight) }}"
                                       min="0">
                            </td>

                            <td>
                                <input type="text"
                                       name="exercise_notes[]"
                                       class="form-control"
                                       value="{{ old('exercise_notes.' . $index) }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">
                Zapisz wykonany trening
            </button>

            <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-secondary">
                Wróć
            </a>
        </form>

    @endif

@endsection