<?php

namespace App\Services;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseService
{
    public function getAll(Request $request = null)
    {
        $query = Exercise::with('muscleGroup')
        ->where('is_active', true);

        if ($request) {
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%'); //użyty like do późniejszego wyszukiwania po nazwie
            }

            if ($request->filled('muscle_group_id')) {
                $query->where('muscle_group_id', $request->muscle_group_id); //do filtrowania po grupie mięśniowej
            }
        }

        return $query
            ->orderBy('id')
            ->get();
    }
    public function getById(int $id)
    {
        return Exercise::with('muscleGroup')
            ->where('is_active', true)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function addToDb(Request $request)
    {
        $request->validate([
            'muscle_group_id' => 'required|exists:muscle_groups,id',
            'name' => 'required|string|max:150|unique:exercises,name',
            'description' => 'nullable|string',
        ]);

        return Exercise::create([
            'muscle_group_id' => $request->muscle_group_id,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,
        ]);
    }

    public function updateInDb(Request $request, int $id)
    {
        $exercise = $this->getById($id);

        $request->validate([
            'muscle_group_id' => 'required|exists:muscle_groups,id',
            'name' => 'required|string|max:150|unique:exercises,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $exercise->update([
            'muscle_group_id' => $request->muscle_group_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $exercise;
    }
    public function deactivate(int $id)
    {
        $exercise = $this->getById($id);

        $exercise->update([
            'is_active' => false,
        ]);

        return $exercise;
    }
}