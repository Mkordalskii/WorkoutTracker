@extends('main')

@section('title', 'Szczegóły wykonanego treningu')

@section('header')
    <div>
        <h1>{{ $workoutLog->workout->name }}</h1>
        <p class="text-muted mb-0">
            Wykonano: {{ $workoutLog->performed_at->format('Y-m-d') }}
        </p>
    </div>
@endsection

@section('content')

    <div class="mb-4">
        <p>
            <strong>Czas trwania:</strong>
            @if($workoutLog->duration_minutes)
                {{ $workoutLog->duration_minutes }} minut
            @else
                -
            @endif
        </p>

        <p>
            <strong>Podsumowanie:</strong>
            {{ $workoutLog->summary ?? '-' }}
        </p>
    </div>

    <h4 class="mb-3">Wykonane ćwiczenia</h4>

    @if($workoutLog->workoutLogExercises->count() > 0)

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Ćwiczenie</th>
                    <th>Grupa</th>
                    <th>Serie</th>
                    <th>Powtórzenia</th>
                    <th>Ciężar</th>
                    <th>Notatki</th>
                </tr>
            </thead>

            <tbody>
                @foreach($workoutLog->workoutLogExercises as $item)
                    <tr>
                        <td>{{ $item->exercise->name }}</td>
                        <td>{{ $item->exercise->muscleGroup->name ?? '-' }}</td>
                        <td>{{ $item->actual_sets }}</td>
                        <td>{{ $item->actual_reps }}</td>
                        <td>
                            @if($item->actual_weight !== null)
                                {{ $item->actual_weight }} kg
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <div class="alert alert-info">
            Brak szczegółów ćwiczeń.
        </div>

    @endif

    <a href="{{ route('workout-logs.index') }}" class="btn btn-secondary">
        Wróć do historii
    </a>

@endsection