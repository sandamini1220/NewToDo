@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Tasks</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 mb-3">
        <div class="col">
            <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ request('q') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No tasks found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $tasks->links() }}
</div>
@endsection
