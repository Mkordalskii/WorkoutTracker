<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\Workout;
use App\Models\WorkoutLog;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getData(): array
    {
        $userId = Auth::id();

        $workoutsCount = Workout::where('user_id', $userId)
            ->where('is_active', true)
            ->count();

        $workoutLogsCount = WorkoutLog::where('user_id', $userId)
            ->where('is_active', true)
            ->count();

        $exercisesCount = Exercise::where('is_active', true)
            ->count();

        $lastWorkoutLogs = WorkoutLog::with('workout')
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->orderBy('performed_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $lastWorkouts = Workout::where('user_id', $userId)
            ->where('is_active', true)
            ->orderBy('training_date', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return [
            'workoutsCount' => $workoutsCount,
            'workoutLogsCount' => $workoutLogsCount,
            'exercisesCount' => $exercisesCount,
            'lastWorkoutLogs' => $lastWorkoutLogs,
            'lastWorkouts' => $lastWorkouts,
        ];
    }
}