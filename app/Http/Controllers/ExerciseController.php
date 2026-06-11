<?php

namespace App\Http\Controllers;

use App\Services\ExerciseService;
use App\Services\MuscleGroupService;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    private ExerciseService $exerciseService;
    private MuscleGroupService $muscleGroupService;

    public function __construct()
    {
        $this->exerciseService = new ExerciseService();
        $this->muscleGroupService = new MuscleGroupService();
    }

    public function index(Request $request)
    {
        $exercises = $this->exerciseService->getAll($request);
        $muscleGroups = $this->muscleGroupService->getAll();

        return view('exercises.index', [
            'exercises' => $exercises,
            'muscleGroups' => $muscleGroups,
        ]);
    }

    public function create()
    {
        $muscleGroups = $this->muscleGroupService->getAll();

        return view('exercises.create', [
            'muscleGroups' => $muscleGroups,
        ]);
    }

    public function store(Request $request)
    {
        $this->exerciseService->addToDb($request);

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Ćwiczenie zostało dodane.');
    }

    public function edit(int $id)
    {
        $exercise = $this->exerciseService->getById($id);
        $muscleGroups = $this->muscleGroupService->getAll();

        return view('exercises.edit', [
            'exercise' => $exercise,
            'muscleGroups' => $muscleGroups,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->exerciseService->updateInDb($request, $id);

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Ćwiczenie zostało zaktualizowane.');
    }

    public function destroy(int $id)
    {
        $this->exerciseService->deactivate($id);

        return redirect()
            ->route('exercises.index')
            ->with('success', 'Ćwiczenie zostało dezaktywowane.');
    }
}
