@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row">
        <x-summary-card title="Total Users" count="{{ $totalUsers }}" color="primary" />
        <x-summary-card title="Total Tasks" count="{{ $totalTasks }}" color="success" />
        <x-summary-card title="Completed Tasks" count="{{ $completedTasks }}" color="info" />
        <x-summary-card title="Pending Tasks" count="{{ $pendingTasks }}" color="warning" />
    </div>

    <!-- Users Table -->
    <div class="mt-5">
        <h4 class="mb-3">Users</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th><th>Email</th><th>Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

    <!-- Tasks Table -->
    <div class="mt-5">
        <h4 class="mb-3">All Tasks</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th><th>Status</th><th>User</th><th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->user->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No tasks available.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $tasks->links() }}
    </div>
</div>
@endsection
