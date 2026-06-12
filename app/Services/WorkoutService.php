<?php

namespace App\Services;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutService
{
    public function getAll(Request $request = null)
    {
        $query = Workout::where('is_active', true)
            ->where('user_id', Auth::id()); // zeby użytkownik widział tylko swoje treningi

        if ($request) {
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%'); //z like do wyszukiwania
            }

            if ($request->filled('training_date')) {
                $query->where('training_date', $request->training_date);
            }
        }

        return $query
            ->orderBy('training_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getById(int $id)
    {
        return Workout::where('is_active', true)
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
    }

    public function addToDb(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'training_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        return Workout::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'training_date' => $request->training_date,
            'notes' => $request->notes,
            'is_active' => true
        ]);
    }

    public function updateInDb(Request $request, int $id)
    {
        $workout = $this->getById($id);

        $request->validate([
            'name' => 'required|string|max:150',
            'training_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $workout->update([
            'name' => $request->name,
            'training_date' => $request->training_date,
            'notes' => $request->notes
        ]);

        return $workout;
    }

    public function deactivate(int $id)
    {
        $workout = $this->getById($id);

        $workout->update([
            'is_active' => false
        ]);

        return $workout;
    }

    public function getDetails(int $id)
    {
        return Workout::with([
                'workoutExercises' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('order_number')
                        ->orderBy('id');
                },
                'workoutExercises.exercise.muscleGroup'
            ])
            ->where('is_active', true)
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
    }
}