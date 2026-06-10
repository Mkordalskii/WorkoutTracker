<?php

use App\Http\Controllers\MuscleGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
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