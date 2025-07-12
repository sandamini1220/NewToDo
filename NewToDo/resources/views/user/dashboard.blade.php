<x-app-layout>
    <div class="container mt-5">
        <h2>Welcome, {{ Auth::user()->name }}</h2>

        <div class="my-4">
            <h4>Task Summary</h4>
            <ul class="list-group w-50">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Tasks
                    <span class="badge bg-primary rounded-pill">{{ $totalTasks }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Completed Tasks
                    <span class="badge bg-success rounded-pill">{{ $completedTasks }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Pending Tasks
                    <span class="badge bg-warning rounded-pill">{{ $pendingTasks }}</span>
                </li>
            </ul>
        </div>

        <div class="my-4">
            <h4>Recent Tasks</h4>

            @if($tasks->isEmpty())
                <p>No recent tasks found.</p>
            @else
                <table class="table table-striped w-75">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>
                                    @if($task->status === 'Completed')
                                        <span class="badge bg-success">{{ $task->status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $task->status }}</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
