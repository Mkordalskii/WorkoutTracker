<?php

namespace App\Http\Controllers;

use App\Services\MuscleGroupService;
use Illuminate\Http\Request;

class MuscleGroupController extends Controller
{
    private MuscleGroupService $muscleGroupService;
    public function __construct()
    {
        $this->muscleGroupService = new MuscleGroupService();
    }

    public function index()
    {
        $muscleGroups = $this->muscleGroupService->getAll();
        return view('muscleGroups.index',['muscleGroups' => $muscleGroups]);
    }

    public function create()
    {
        return view('muscleGroups.create');
    }

    public function store(Request $request)
    {
        $this->muscleGroupService->addToDb($request);

        return redirect()
            ->route('muscle-groups.index')
            ->with('success', 'Grupa mięśniowa została dodana.');//dodaje komunikat
    }
     
    public function edit(int $id)
    {
        $muscleGroup = $this->muscleGroupService->getById($id);

        return view('muscleGroups.edit', ['muscleGroup' => $muscleGroup]);
    }
    
    public function update(Request $request, int $id)
    {
        $this->muscleGroupService->updateInDb($request, $id);

        return redirect()
            ->route('muscle-groups.index')
            ->with('success', 'Grupa mięśniowa została zaktualizowana.');
    }
    
    public function destroy(int $id)
    {
        $this->muscleGroupService->deactivate($id);

        return redirect()
            ->route('muscle-groups.index')
            ->with('success', 'Grupa mięśniowa została dezaktywowana.');
    }
}
