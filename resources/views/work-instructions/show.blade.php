@extends('layouts.app')

@section('title', "Work Instructions $workInstruction->name")

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">WorkInstruction Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $workInstruction->user->name }}</p>
                        <p><strong>WorkInstruction Code:</strong> {{ $workInstruction->work_date }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('work-instructions.index') }}" class="btn btn-default">Back to WorkInstructions</a>
            </div>
        </div>
    </div>

@endsection
