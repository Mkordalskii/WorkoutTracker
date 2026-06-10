@extends('main')

@section('title', 'Edytuj grupę mięśniową')

@section('header')
    <h1>Edytuj grupę mięśniową</h1>
@endsection

@section('content')

    <form action="{{ route('muscle-groups.update', $muscleGroup->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nazwa grupy</label>

            <input type="text"
                   name="name"
                   id="name"
                   class="form-control"
                   value="{{ old('name', $muscleGroup->name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>

            <textarea name="description"
                      id="description"
                      class="form-control"
                      rows="4">{{ old('description', $muscleGroup->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Zapisz zmiany
        </button>

        <a href="{{ route('muscle-groups.index') }}" class="btn btn-secondary">
            Wróć
        </a>
    </form>

@endsection