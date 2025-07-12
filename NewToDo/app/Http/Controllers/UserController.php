<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class UserController extends Controller
{
    /**
     * Show the user's dashboard with recent tasks and stats.
     */
    public function index()
    {
        $userId = auth()->id();

        $tasks = Task::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $totalTasks = Task::where('user_id', $userId)->count();

        $completedTasks = Task::where('user_id', $userId)
            ->where('status', 'Completed')
            ->count();

        $pendingTasks = Task::where('user_id', $userId)
            ->where('status', 'Pending')
            ->count();

        return view('user.dashboard', compact('tasks', 'totalTasks', 'completedTasks', 'pendingTasks'));
    }
}
