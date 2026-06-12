<?php

namespace App\Services;

use App\Models\Workout;
use App\Models\WorkoutLog;
use App\Models\WorkoutLogExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkoutLogService
{
    public function getAll(Request $request = null)
    {
        $query = WorkoutLog::with('workout')
            ->where('user_id', Auth::id())
            ->where('is_active', true);
        //filtrowanie po dacie wykonania
        if ($request) {
            if ($request->filled('performed_at')) {
                $query->where('performed_at', $request->performed_at);
            }
            //filtrowanie po nazwie treningu
            if ($request->filled('workout_name')) {
                $query->whereHas('workout', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->workout_name . '%'); //użyty whereHas żeby dostać się do workout_name
                });
            }
        }

        return $query
            ->orderBy('performed_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getWorkoutForCurrentUser(int $workoutId)
    {
        return Workout::with([
                'workoutExercises' => function ($query) {
                    $query->orderBy('order_number')->orderBy('id');
                },
                'workoutExercises.exercise'
            ])
            ->where('id', $workoutId)
            ->where('user_id', Auth::id())
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function getById(int $id)
    {
        return WorkoutLog::with([
                'workout',
                'workoutLogExercises.exercise.muscleGroup'
            ])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function addToDb(Request $request, int $workoutId)
    {
        $workout = $this->getWorkoutForCurrentUser($workoutId);

        $request->validate([
            'performed_at' => 'required|date',
            'duration_minutes' => 'nullable|integer|min:1|max:1000',
            'summary' => 'nullable|string',

            'exercise_id' => 'required|array',
            'exercise_id.*' => 'required|exists:exercises,id',

            'actual_sets' => 'required|array',
            'actual_sets.*' => 'required|integer|min:1|max:100',

            'actual_reps' => 'required|array',
            'actual_reps.*' => 'required|integer|min:1|max:1000',

            'actual_weight' => 'nullable|array',
            'actual_weight.*' => 'nullable|numeric|min:0|max:9999.99',

            'exercise_notes' => 'nullable|array',
            'exercise_notes.*' => 'nullable|string',
        ]);

        //tworzymy transakcje bo zapisujemy dane do dwóch tabel workout_logs i workout_log_exercises
        DB::transaction(function () use ($request, $workout) {
            $workoutLog = WorkoutLog::create([
                'user_id' => Auth::id(),
                'workout_id' => $workout->id,
                'performed_at' => $request->performed_at,
                'duration_minutes' => $request->duration_minutes,
                'summary' => $request->summary,
                'is_active' => true,
            ]);
            //pętla przechodząca po wszystkich ćwiczeniach wysłanych z formularza
            foreach ($request->exercise_id as $index => $exerciseId) {
                WorkoutLogExercise::create([
                    'workout_log_id' => $workoutLog->id,
                    'exercise_id' => $exerciseId,
                    'actual_sets' => $request->actual_sets[$index],
                    'actual_reps' => $request->actual_reps[$index],
                    'actual_weight' => $request->actual_weight[$index] ?? null,
                    'notes' => $request->exercise_notes[$index] ?? null,
                    'is_active' => true,
                ]);
            }
        });
    }

    public function deactivate(int $id)
    {
        $workoutLog = $this->getById($id);

        $workoutLog->update([
            'is_active' => false,
        ]);

        return $workoutLog;
    }
}