<?php

namespace App\Http\Controllers;

use App\Services\WorkoutService;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    private WorkoutService $workoutService;

    public function __construct()
    {
        $this->workoutService = new WorkoutService();
    }

    public function index(Request $request)
    {
        $workouts = $this->workoutService->getAll($request);

        return view('workouts.index', [
            'workouts' => $workouts,
        ]);
    }

    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $this->workoutService->addToDb($request);

        return redirect()
            ->route('workouts.index')
            ->with('success', 'Trening został dodany.');
    }

    public function edit(int $id)
    {
        $workout = $this->workoutService->getById($id);

        return view('workouts.edit', [
            'workout' => $workout,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->workoutService->updateInDb($request, $id);

        return redirect()
            ->route('workouts.index')
            ->with('success', 'Trening został zaktualizowany.');
    }

    public function destroy(int $id)
    {
        $this->workoutService->deactivate($id);

        return redirect()
            ->route('workouts.index')
            ->with('success', 'Trening został dezaktywowany.');
    }

    public function show(int $id)
{
    $workout = $this->workoutService->getDetails($id);

    return view('workouts.show', [
        'workout' => $workout,
    ]);
}
}
