<?php

namespace App\Http\Controllers;

use App\Services\WorkoutLogService;
use Illuminate\Http\Request;

class WorkoutLogController extends Controller
{
    private WorkoutLogService $workoutLogService;

    public function __construct()
    {
        $this->workoutLogService = new WorkoutLogService();
    }

    public function index(Request $request)
    {
        $workoutLogs = $this->workoutLogService->getAll($request);

        return view('workoutLogs.index', [
            'workoutLogs' => $workoutLogs,
        ]);
    }

    public function create(int $workoutId)
    {
        $workout = $this->workoutLogService->getWorkoutForCurrentUser($workoutId);

        return view('workoutLogs.create', [
            'workout' => $workout,
        ]);
    }

    public function store(Request $request, int $workoutId)
    {
        $this->workoutLogService->addToDb($request, $workoutId);

        return redirect()
            ->route('workout-logs.index')
            ->with('success', 'Wykonany trening został zapisany.');
    }

    public function show(int $id)
    {
        $workoutLog = $this->workoutLogService->getById($id);

        return view('workoutLogs.show', [
            'workoutLog' => $workoutLog,
        ]);
    }

    public function destroy(int $id)
    {
        $this->workoutLogService->deactivate($id);

        return redirect()
            ->route('workout-logs.index')
            ->with('success', 'Wpis historii został dezaktywowany.');
    }
}
