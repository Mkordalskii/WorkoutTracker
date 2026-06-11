@extends('main')

@section('title', 'Edytuj ćwiczenie')

@section('header')
    <h1>Edytuj ćwiczenie</h1>
@endsection

@section('content')

    <form action="{{ route('exercises.update', $exercise->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="muscle_group_id" class="form-label">Grupa mięśniowa</label>

            <select name="muscle_group_id" id="muscle_group_id" class="form-select" required>
                <option value="">-- wybierz grupę --</option>

                @foreach($muscleGroups as $muscleGroup)
                    <option value="{{ $muscleGroup->id }}"
                        {{ old('muscle_group_id', $exercise->muscle_group_id) == $muscleGroup->id ? 'selected' : '' }}>
                        {{ $muscleGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa ćwiczenia</label>

            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ old('name', $exercise->name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>

            <textarea name="description"
                      id="description"
                      class="form-control"
                      rows="4">{{ old('description', $exercise->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Zapisz zmiany
        </button>

        <a href="{{ route('exercises.index') }}" class="btn btn-secondary">
            Wróć
        </a>
    </form>

@endsection