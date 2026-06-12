<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MuscleGroupController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutExerciseController;
use App\Http\Controllers\WorkoutLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.index');
    }
    return redirect()->route('login');
});
//autoryzacja
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/muscle-groups', [MuscleGroupController::class, 'index'])
        ->name('muscle-groups.index');

    Route::get('/muscle-groups/create', [MuscleGroupController::class, 'create'])
        ->name('muscle-groups.create');

    Route::post('/muscle-groups', [MuscleGroupController::class, 'store'])
        ->name('muscle-groups.store');

    Route::get('/muscle-groups/{id}/edit', [MuscleGroupController::class, 'edit'])
        ->name('muscle-groups.edit');

    Route::put('/muscle-groups/{id}', [MuscleGroupController::class, 'update'])
        ->name('muscle-groups.update');

    Route::delete('/muscle-groups/{id}', [MuscleGroupController::class, 'destroy'])
        ->name('muscle-groups.destroy');


    Route::get('/exercises', [ExerciseController::class, 'index'])
        ->name('exercises.index');

    Route::get('/exercises/create', [ExerciseController::class, 'create'])
        ->name('exercises.create');

    Route::post('/exercises', [ExerciseController::class, 'store'])
        ->name('exercises.store');

    Route::get('/exercises/{id}/edit', [ExerciseController::class, 'edit'])
        ->name('exercises.edit');

    Route::put('/exercises/{id}', [ExerciseController::class, 'update'])
        ->name('exercises.update');

    Route::delete('/exercises/{id}', [ExerciseController::class, 'destroy'])
        ->name('exercises.destroy');

    Route::get('/workouts', [WorkoutController::class, 'index'])
        ->name('workouts.index');

    Route::get('/workouts/create', [WorkoutController::class, 'create'])
        ->name('workouts.create');

    Route::post('/workouts', [WorkoutController::class, 'store'])
        ->name('workouts.store');

    Route::get('/workouts/{id}/edit', [WorkoutController::class, 'edit'])
        ->name('workouts.edit');

    Route::put('/workouts/{id}', [WorkoutController::class, 'update'])
        ->name('workouts.update');

    Route::delete('/workouts/{id}', [WorkoutController::class, 'destroy'])
        ->name('workouts.destroy');

    Route::get('/workouts/{id}', [WorkoutController::class, 'show'])
        ->name('workouts.show');

    Route::get('/workouts/{workoutId}/exercises/create', [WorkoutExerciseController::class, 'create'])
        ->name('workout-exercises.create');

    Route::post('/workouts/{workoutId}/exercises', [WorkoutExerciseController::class, 'store'])
        ->name('workout-exercises.store');

    Route::get('/workout-exercises/{id}/edit', [WorkoutExerciseController::class, 'edit'])
        ->name('workout-exercises.edit');

    Route::put('/workout-exercises/{id}', [WorkoutExerciseController::class, 'update'])
        ->name('workout-exercises.update');

    Route::delete('/workout-exercises/{id}', [WorkoutExerciseController::class, 'destroy'])
        ->name('workout-exercises.destroy');

    Route::get('/workout-logs', [WorkoutLogController::class, 'index'])
        ->name('workout-logs.index');

    Route::get('/workouts/{workoutId}/logs/create', [WorkoutLogController::class, 'create'])
        ->name('workout-logs.create');

    Route::post('/workouts/{workoutId}/logs', [WorkoutLogController::class, 'store'])
        ->name('workout-logs.store');

    Route::get('/workout-logs/{id}', [WorkoutLogController::class, 'show'])
        ->name('workout-logs.show');

    Route::delete('/workout-logs/{id}', [WorkoutLogController::class, 'destroy'])
        ->name('workout-logs.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');
});