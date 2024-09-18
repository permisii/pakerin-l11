<?php

namespace App\Http\Controllers;

use App\DataTables\AssignmentsDataTable;
use App\Http\Requests\Assignment\StoreAssignmentRequest;
use App\Http\Requests\Assignment\UpdateAssignmentRequest;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Models\WorkInstruction;

class AssignmentController extends Controller {
    public function index(AssignmentsDataTable $dataTable, WorkInstruction $workInstruction) {
        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            'Assignments' => '',
        ]);

        return $dataTable->with('work_instruction_id', $workInstruction->id)->render('assignments.index', [
            'breadcrumbs' => $this->getBreadcrumbs(),
            'workInstruction' => $workInstruction,
        ]);
    }

    public function create(WorkInstruction $workInstruction) {
        $assignments = AssignmentResource::collection(Assignment::all());

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            'Create Assignment' => '',
        ]);

        return $this->renderView('assignments.create', [
            'assignments' => $assignments,
            'workInstruction' => $workInstruction,
        ]);
    }

    public function store(StoreAssignmentRequest $request, WorkInstruction $workInstruction) {
        $assignment = new Assignment($request->validated());
        $assignment->work_instruction_id = $workInstruction->id;
        $assignment->save();

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)->with('success', 'Assignment created.');
    }

    public function show(WorkInstruction $workInstruction, Assignment $assignment) {
        $assignment = new AssignmentResource($assignment->load('workInstruction', 'updatedBy', 'createdBy'));

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            $assignment->name => '',
        ]);

        return $this->renderView('assignments.show', [
            'assignment' => $assignment,
            'workInstruction' => $workInstruction,
        ]);
    }

    public function edit(WorkInstruction $workInstruction, Assignment $assignment) {
        $assignment = new AssignmentResource($assignment);

        $this->setBreadcrumbs([
            'Home' => route('dashboard'),
            'Work Instructions' => route('work-instructions.index'),
            $workInstruction->id => route('work-instructions.show', $workInstruction->id),
            $assignment->name => route('work-instructions.assignments.show', [$workInstruction->id, $assignment->id]),
            'Edit' => '',
        ]);

        return $this->renderView('assignments.edit', [
            'assignment' => $assignment,
            'workInstruction' => $workInstruction,
        ]);
    }

    public function update(UpdateAssignmentRequest $request, WorkInstruction $workInstruction, Assignment $assignment) {
        $assignment->update($request->validated());

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)->with('success', 'Assignment updated.');
    }

    public function destroy(WorkInstruction $workInstruction, Assignment $assignment) {
        $assignment->delete();

        return redirect()->route('work-instructions.assignments.index', $workInstruction->id)->with('success', 'Assignment deleted.');
    }
}
