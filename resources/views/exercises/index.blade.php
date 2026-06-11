@extends('main')

@section('title', 'Ćwiczenia')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Ćwiczenia</h1>

        <a href="{{ route('exercises.create') }}" class="btn btn-primary">
            Dodaj ćwiczenie
        </a>
    </div>
@endsection

@section('content')

    <form method="GET" action="{{ route('exercises.index') }}" class="row g-3 mb-4">
        <div class="col-md-5">
            <label for="name" class="form-label">Nazwa ćwiczenia</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ request('name') }}"
                   placeholder="Np. przysiad, sztanga, plank">
        </div>

        <div class="col-md-5">
            <label for="muscle_group_id" class="form-label">Grupa mięśniowa</label>
            <select name="muscle_group_id" id="muscle_group_id" class="form-select">
                <option value="">Wszystkie grupy</option>

                @foreach($muscleGroups as $muscleGroup)
                    <option value="{{ $muscleGroup->id }}"
                        {{ request('muscle_group_id') == $muscleGroup->id ? 'selected' : '' }}>
                        {{ $muscleGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">
                Szukaj
            </button>
        </div>
    </form>

    @if($exercises->count() > 0)

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Nazwa</th>
                <th>Grupa mięśniowa</th>
                <th>Opis</th>
                <th style="width: 220px;">Akcje</th>
            </tr>
            </thead>

            <tbody>
            @foreach($exercises as $exercise)
                <tr>
                    <td>{{ $exercise->id }}</td>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->muscleGroup->name ?? 'Brak' }}</td>
                    <td>{{ $exercise->description }}</td>
                    <td>
                        <a href="{{ route('exercises.edit', $exercise->id) }}"
                           class="btn btn-warning btn-sm">
                            Edytuj
                        </a>

                        <form action="{{ route('exercises.destroy', $exercise->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Czy na pewno chcesz dezaktywować to ćwiczenie?')">
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
            Brak aktywnych ćwiczeń.
        </div>

    @endif

@endsection