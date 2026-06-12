@extends('main')

@section('title', 'Szczegóły treningu')

@section('header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1>{{ $workout->name }}</h1>
        <p class="text-muted mb-0">
            Data treningu: {{ $workout->training_date->format('Y-m-d') }}
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('workout-logs.create', $workout->id) }}" class="btn btn-success">
            Zarejestruj wykonanie
        </a>

        <a href="{{ route('workout-exercises.create', $workout->id) }}" class="btn btn-primary">
            Dodaj ćwiczenie
        </a>
    </div>
</div>
@endsection

@section('content')

@if($workout->notes)
<div class="alert alert-secondary">
    {{ $workout->notes }}
</div>
@endif

<h4 class="mb-3">Ćwiczenia w treningu</h4>

@if($workout->workoutExercises->count() > 0)

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width: 80px;">Lp.</th>
            <th>Ćwiczenie</th>
            <th>Grupa</th>
            <th>Serie</th>
            <th>Powtórzenia</th>
            <th>Ciężar</th>
            <th>Notatki</th>
            <th style="width: 220px;">Akcje</th>
        </tr>
    </thead>

    <tbody>
        @foreach($workout->workoutExercises as $item)
        <tr>
            <td>{{ $item->order_number }}</td>
            <td>{{ $item->exercise->name }}</td>
            <td>{{ $item->exercise->muscleGroup->name ?? '-' }}</td>
            <td>{{ $item->planned_sets }}</td>
            <td>{{ $item->planned_reps }}</td>
            <td>
                @if($item->planned_weight !== null)
                {{ $item->planned_weight }} kg
                @else
                -
                @endif
            </td>
            <td>{{ $item->notes }}</td>
            <td>
                <a href="{{ route('workout-exercises.edit', $item->id) }}"
                    class="btn btn-warning btn-sm">
                    Edytuj
                </a>

                <form action="{{ route('workout-exercises.destroy', $item->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Czy na pewno chcesz usunąć to ćwiczenie z treningu?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                        Usuń
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else

<div class="alert alert-info">
    Ten trening nie ma jeszcze przypisanych ćwiczeń.
</div>

@endif

<a href="{{ route('workouts.index') }}" class="btn btn-secondary">
    Wróć do treningów
</a>

@endsection