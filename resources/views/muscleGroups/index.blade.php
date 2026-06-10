@extends('main')

@section('title', 'Grupy mięśniowe')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Grupy mięśniowe</h1>

        <a href="{{ route('muscle-groups.create') }}" class="btn btn-primary">
            Dodaj grupę
        </a>
    </div>
@endsection

@section('content')

    @if($muscleGroups->count() > 0)

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th style="width: 220px;">Akcje</th>
                </tr>
            </thead>

            <tbody>
                @foreach($muscleGroups as $muscleGroup)
                    <tr>
                        <td>{{ $muscleGroup->id }}</td>
                        <td>{{ $muscleGroup->name }}</td>
                        <td>{{ $muscleGroup->description }}</td>
                        <td>
                            <a href="{{ route('muscle-groups.edit', $muscleGroup->id) }}"
                               class="btn btn-warning btn-sm">
                                Edytuj
                            </a>

                            <form action="{{ route('muscle-groups.destroy', $muscleGroup->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Czy na pewno chcesz dezaktywować tę grupę?')">
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
            Brak aktywnych grup mięśniowych.
        </div>

    @endif

@endsection