<tr>
    <th>
        <div class="btn-group">
            <a href="{{ route('work-instructions.assignments.show', [$workInstructionId, $id]) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-info-circle"></i>
                Detail
            </a>
            <form action="{{ route('work-instructions.assignments.destroy', [$workInstructionId, $id]) }}" method="post"
                  id="delete-form-{{ $id }}">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $id }})"
                        class="btn btn-sm btn-default text-danger action-btn">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
            <a href="{{ route('work-instructions.assignments.edit', [$workInstructionId, $id]) }}"
               class="btn btn-sm btn-default text-blue action-btn">
                <i class="fas fa-edit"></i>
                Edit
            </a>
        </div>
    </th>
</tr>
