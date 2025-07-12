@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create New Task</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="form-control @error('title') is-invalid @enderror" 
                value="{{ old('title') }}" 
                required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control @error('description') is-invalid @enderror" 
                rows="4">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline <span class="text-danger">*</span></label>
            <input 
                type="date" 
                name="deadline" 
                id="deadline" 
                class="form-control @error('deadline') is-invalid @enderror" 
                value="{{ old('deadline') }}" 
                required>
            @error('deadline')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select 
                name="status" 
                id="status" 
                class="form-select @error('status') is-invalid @enderror" 
                required>
                <option value="">-- Select Status --</option>
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Save Task</button>
        </div>
    </form>
</div>
@endsection
