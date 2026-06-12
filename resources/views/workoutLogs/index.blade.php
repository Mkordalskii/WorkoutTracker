@extends('main')

@section('title', 'Historia treningów')

@section('header')
    <h1>Historia treningów</h1>
@endsection

@section('content')

    <form method="GET" action="{{ route('workout-logs.index') }}" class="row g-3 mb-4">
        <div class="col-md-5">
            <label for="workout_name" class="form-label">Nazwa treningu</label>
            <input type="text"
                   name="workout_name"
                   id="workout_name"
                   class="form-control"
                   value="{{ request('workout_name') }}"
                   placeholder="Np. Push, Pull, Leg Day">
        </div>

        <div class="col-md-5">
            <label for="performed_at" class="form-label">Data wykonania</label>
            <input type="date"
                   name="performed_at"
                   id="performed_at"
                   class="form-control"
                   value="{{ request('performed_at') }}">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">
                Filtruj
            </button>
        </div>
    </form>

    @if($workoutLogs->count() > 0)

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Trening</th>
                    <th>Data wykonania</th>
                    <th>Czas</th>
                    <th>Podsumowanie</th>
                    <th style="width: 230px;">Akcje</th>
                </tr>
            </thead>

            <tbody>
                @foreach($workoutLogs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->workout->name }}</td>
                        <td>{{ $log->performed_at->format('Y-m-d') }}</td>
                        <td>
                            @if($log->duration_minutes)
                                {{ $log->duration_minutes }} min
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $log->summary }}</td>
                        <td>
                            <a href="{{ route('workout-logs.show', $log->id) }}"
                               class="btn btn-info btn-sm">
                                Szczegóły
                            </a>

                            <form action="{{ route('workout-logs.destroy', $log->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Czy na pewno chcesz dezaktywować ten wpis historii?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Dezaktywuj
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <div class="alert alert-info">
            Brak zapisanych treningów w historii.
        </div>

    @endif

@endsection