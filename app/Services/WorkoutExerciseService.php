<?php

namespace App\Services;

use App\Models\Workout;
use App\Models\WorkoutExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutExerciseService
{
    public function getWorkoutForCurrentUser(int $workoutId)
    {
        return Workout::with([
                'workoutExercises.exercise.muscleGroup'
            ])
            ->where('id', $workoutId)
            ->where('user_id', Auth::id())
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function addToWorkout(Request $request, int $workoutId)
    {
        $workout = $this->getWorkoutForCurrentUser($workoutId);

        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'planned_sets' => 'required|integer|min:1|max:100',
            'planned_reps' => 'required|integer|min:1|max:1000',
            'planned_weight' => 'nullable|numeric|min:0|max:9999.99',
            'order_number' => 'nullable|integer|min:1|max:1000',
            'notes' => 'nullable|string',
        ]);

        $exists = WorkoutExercise::where('workout_id', $workout->id)
            ->where('exercise_id', $request->exercise_id)
            ->exists();

        if ($exists) {
            return false;
        }

        WorkoutExercise::create([
            'workout_id' => $workout->id,
            'exercise_id' => $request->exercise_id,
            'planned_sets' => $request->planned_sets,
            'planned_reps' => $request->planned_reps,
            'planned_weight' => $request->planned_weight,
            'order_number' => $request->order_number ?? 1,
            'notes' => $request->notes,
            'is_active' => true,
        ]);

        return true;
    }

    public function getByIdForCurrentUser(int $id)
    {
        return WorkoutExercise::with('workout', 'exercise')
            ->where('id', $id)
            ->where('is_active', true)
            ->whereHas('workout', function ($query) {
                $query->where('user_id', Auth::id()); //WorkoutExercise nie ma tabeli user_id dlatego wchodzimy do niej przez funkcje whereHas, bo workout ma tę kolumnę
            })
            ->firstOrFail();
    }

    public function updateInDb(Request $request, int $id)
    {
        $workoutExercise = $this->getByIdForCurrentUser($id);

        $request->validate([
            'planned_sets' => 'required|integer|min:1|max:100',
            'planned_reps' => 'required|integer|min:1|max:1000',
            'planned_weight' => 'nullable|numeric|min:0|max:9999.99',
            'order_number' => 'nullable|integer|min:1|max:1000',
            'notes' => 'nullable|string',
        ]);

        $workoutExercise->update([
            'planned_sets' => $request->planned_sets,
            'planned_reps' => $request->planned_reps,
            'planned_weight' => $request->planned_weight,
            'order_number' => $request->order_number ?? 1,
            'notes' => $request->notes,
        ]);

        return $workoutExercise;
    }

    public function delete(int $id)
    {
        $workoutExercise = $this->getByIdForCurrentUser($id);

        $workoutId = $workoutExercise->workout_id;

        $workoutExercise->delete();

        return $workoutId;
    }
}