@extends('main')

@section('title', 'Treningi')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Moje treningi</h1>

        <a href="{{ route('workouts.create') }}" class="btn btn-primary">
            Dodaj trening
        </a>
    </div>
@endsection

@section('content')

    <form method="GET" action="{{ route('workouts.index') }}" class="row g-3 mb-4">
        <div class="col-md-5">
            <label for="name" class="form-label">Nazwa treningu</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ request('name') }}"
                   placeholder="Np. Push, Pull, Leg Day">
        </div>

        <div class="col-md-5">
            <label for="training_date" class="form-label">Data treningu</label>
            <input type="date"
                   name="training_date"
                   id="training_date"
                   class="form-control"
                   value="{{ request('training_date') }}">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">
                Filtruj
            </button>
        </div>
    </form>

    @if($workouts->count() > 0)

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nazwa</th>
                    <th>Data</th>
                    <th>Notatki</th>
                    <th style="width: 240px;">Akcje</th>
                </tr>
            </thead>

            <tbody>
                @foreach($workouts as $workout)
                    <tr>
                        <td>{{ $workout->id }}</td>
                        <td>{{ $workout->name }}</td>
                        <td>{{ $workout->training_date->format('Y-m-d') }}</td>
                        <td>{{ $workout->notes }}</td>
                        <td>
                            <a href="{{ route('workouts.edit', $workout->id) }}"
                               class="btn btn-warning btn-sm">
                                Edytuj
                            </a>

                            <form action="{{ route('workouts.destroy', $workout->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Czy na pewno chcesz dezaktywować ten trening?')">
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
            Brak aktywnych treningów.
        </div>

    @endif

@endsection