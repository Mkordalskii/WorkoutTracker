@extends('main')

@section('title', 'Dashboard')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Dashboard</h1>
            <p class="text-muted mb-0">
                Witaj, {{ auth()->user()->name }}. Tutaj znajdziesz krótkie podsumowanie swoich treningów.
            </p>
        </div>

        <a href="{{ route('workouts.create') }}" class="btn btn-primary">
            Dodaj trening
        </a>
    </div>
@endsection

@section('content')

    <div class="row mb-4">

        <div class="col-md-4 mb-3">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Aktywne treningi</h5>
                    <p class="display-5 mb-0">{{ $workoutsCount }}</p>
                    <p class="text-muted mb-0">Twoje zapisane plany treningowe</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('workouts.index') }}" class="btn btn-outline-primary btn-sm">
                        Zobacz treningi
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Wykonane treningi</h5>
                    <p class="display-5 mb-0">{{ $workoutLogsCount }}</p>
                    <p class="text-muted mb-0">Liczba wpisów w historii</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('workout-logs.index') }}" class="btn btn-outline-success btn-sm">
                        Zobacz historię
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Dostępne ćwiczenia</h5>
                    <p class="display-5 mb-0">{{ $exercisesCount }}</p>
                    <p class="text-muted mb-0">Ćwiczenia dostępne w systemie</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('exercises.index') }}" class="btn btn-outline-dark btn-sm">
                        Zobacz ćwiczenia
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6 mb-4">
            <h4>Ostatnio dodane treningi</h4>

            @if($lastWorkouts->count() > 0)
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nazwa</th>
                            <th>Data</th>
                            <th style="width: 120px;">Akcja</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($lastWorkouts as $workout)
                            <tr>
                                <td>{{ $workout->name }}</td>
                                <td>{{ $workout->training_date->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('workouts.show', $workout->id) }}"
                                       class="btn btn-info btn-sm">
                                        Szczegóły
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    Nie masz jeszcze dodanych treningów.
                </div>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <h4>Ostatnie wykonane treningi</h4>

            @if($lastWorkoutLogs->count() > 0)
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Trening</th>
                            <th>Data wykonania</th>
                            <th style="width: 120px;">Akcja</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($lastWorkoutLogs as $log)
                            <tr>
                                <td>{{ $log->workout->name }}</td>
                                <td>{{ $log->performed_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('workout-logs.show', $log->id) }}"
                                       class="btn btn-info btn-sm">
                                        Szczegóły
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    Nie masz jeszcze zapisanej historii treningów.
                </div>
            @endif
        </div>

    </div>

@endsection