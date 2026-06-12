<?php

namespace App\Http\Controllers;

use App\Services\ExerciseService;
use App\Services\WorkoutExerciseService;
use Illuminate\Http\Request;

class WorkoutExerciseController extends Controller
{
    private WorkoutExerciseService $workoutExerciseService;
    private ExerciseService $exerciseService;

    public function __construct()
    {
        $this->workoutExerciseService = new WorkoutExerciseService();
        $this->exerciseService = new ExerciseService();
    }

    public function create(int $workoutId)
    {
        $workout = $this->workoutExerciseService->getWorkoutForCurrentUser($workoutId);
        $exercises = $this->exerciseService->getAll();

        return view('workoutExercises.create', [
            'workout' => $workout,
            'exercises' => $exercises,
        ]);
    }

    public function store(Request $request, int $workoutId)
    {
        $added = $this->workoutExerciseService->addToWorkout($request, $workoutId);

        if (! $added) {
            return back()
                ->withErrors([
                    'exercise_id' => 'To ćwiczenie jest już dodane do tego treningu.',
                ])
                ->withInput();
        }

        return redirect()
            ->route('workouts.show', $workoutId)
            ->with('success', 'Ćwiczenie zostało dodane do treningu.');
    }

    public function edit(int $id)
    {
        $workoutExercise = $this->workoutExerciseService->getByIdForCurrentUser($id);

        return view('workoutExercises.edit', [
            'workoutExercise' => $workoutExercise,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $workoutExercise = $this->workoutExerciseService->updateInDb($request, $id);

        return redirect()
            ->route('workouts.show', $workoutExercise->workout_id)
            ->with('success', 'Parametry ćwiczenia zostały zaktualizowane.');
    }

    public function destroy(int $id)
    {
        $workoutId = $this->workoutExerciseService->delete($id);

        return redirect()
            ->route('workouts.show', $workoutId)
            ->with('success', 'Ćwiczenie zostało usunięte z treningu.');
    }
}
