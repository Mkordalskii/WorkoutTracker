<?php
namespace App\Services;

use App\Models\MuscleGroup;
use Illuminate\Http\Request;

class MuscleGroupService
{
    public function getAll()
    {
        return MuscleGroup::where('is_active', true)
        ->orderBy('name')
        ->get();
    }
    public function getById(int $id)
    {
        return MuscleGroup::where('is_active', true)
        ->where('id', $id)
        ->firstOrFail(); //pierwszy znaleziony lub blad 404
    }
    public function addToDb(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:muscle_groups,name',
            'description' => 'nullable|string',
        ]);
        return MuscleGroup::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,
        ]);
    }
    public function updateInDb(Request $request, int $id)
    {
        $muscleGroup = $this->getById($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:muscle_groups,name,' . $id, //nazwa unikalna ale pominie aktualnie edytowany rekord
            'description' => 'nullable|string',
        ]);

        $muscleGroup->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $muscleGroup;
    }
    public function deactivate(int $id)
    {
        $muscleGroup = $this->getById($id);

        $muscleGroup->update([
            'is_active' => false,
        ]);

        return $muscleGroup;
    }
}