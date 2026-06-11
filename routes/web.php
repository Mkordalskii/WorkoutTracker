<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MuscleGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//grupy mięśniowe
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

//ćwiczenia
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