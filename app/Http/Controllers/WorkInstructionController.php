<?php

namespace App\Http\Controllers;

use App\DataTables\WorkInstructionsDataTable;
use App\Http\Requests\WorkInstruction\StoreWorkInstructionRequest;
use App\Http\Requests\WorkInstruction\UpdateWorkInstructionRequest;
use App\Http\Resources\WorkInstructionResource;
use App\Models\WorkInstruction;

class WorkInstructionController extends Controller {
    public function index(WorkInstructionsDataTable $dataTable) {
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => '',
        ]);

        return $dataTable->render('work-instructions.index', ['breadcrumbs' => $this->getBreadcrumbs()]);
    }

    public function create() {
        $workInstruction = WorkInstructionResource::collection(WorkInstruction::all());

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            'Create' => '',
        ]);

        return $this->renderView('work-instructions.create');
    }

    public function store(StoreWorkInstructionRequest $request) {
        WorkInstruction::create($request->validated());

        return redirect()->route('work-instructions.index')->with('success', 'WorkInstruction created.');
    }

    public function show(WorkInstruction $workInstruction) {
        $workInstruction = new WorkInstructionResource($workInstruction->load('user', 'updatedBy', 'createdBy'));

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            $workInstruction->name => '',
        ]);

        return $this->renderView('work-instructions.show', ['workInstruction' => $workInstruction]);
    }

    public function edit(WorkInstruction $workInstruction) {
        $workInstruction = new WorkInstructionResource($workInstruction);

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            $workInstruction->name => route('work-instructions.show', $workInstruction->id),
            'Edit' => '',
        ]);

        return $this->renderView('work-instructions.edit', ['workInstruction' => $workInstruction]);
    }

    public function update(UpdateWorkInstructionRequest $request, WorkInstruction $workInstruction) {
        $workInstruction->update($request->validated());

        return redirect()->route('work-instructions.index')->with('success', 'WorkInstruction updated.');
    }

    public function destroy(WorkInstruction $workInstruction) {
        $workInstruction->delete();

        return redirect()->route('work-instructions.index')->with('success', 'WorkInstruction deleted.');
    }
}
