<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">🧘 ToDo App</h2>
            <nav>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-600 font-semibold">My Task</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600">Ultimate Goals</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600">New Dashboard</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h2 class="text-3xl font-bold mb-6">📌 My Task</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Calendar Column -->
                <div class="md:col-span-2 bg-white p-4 rounded shadow">
                    <h3 class="text-xl font-semibold mb-4">Calendar View</h3>
                    <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-600">
                        @for($i = 1; $i <= 30; $i++)
                            <div class="p-2 border rounded {{ $i == now()->day ? 'bg-blue-100 border-blue-400' : 'bg-gray-50' }}">
                                {{ $i }}
                                @foreach ($tasks as $task)
                                    @if (\Carbon\Carbon::parse($task->deadline)->day == $i)
                                        <div class="mt-1 text-xs text-left p-1 bg-yellow-100 rounded">
                                            {{ $task->title }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-xl font-semibold mb-4">📋 Recently Tasks</h3>
                    <ul class="space-y-2 text-sm">
                        @foreach ($tasks as $task)
                            <li class="flex justify-between items-center border-b pb-1">
                                <span>{{ $task->title }}</span>
                                <span class="text-xs {{ $task->status == 'Completed' ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $task->status }}
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-2">📈 Daily Progress</h4>
                        <canvas id="progressChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    data: [{{ $completedTasks }}, {{ $pendingTasks }}],
                    backgroundColor: ['#4ade80', '#facc15']
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
