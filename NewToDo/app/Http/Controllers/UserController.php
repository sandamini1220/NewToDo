<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class UserController extends Controller
{
    /**
     * Display the authenticated user's dashboard with task summary and recent tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all tasks of the logged-in user
        $tasks = auth()->user()->tasks()->latest()->get();

        // Count totals using collection methods
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'Completed')->count();
        $pendingTasks = $tasks->where('status', 'Pending')->count();

        // Return dashboard view with data
        return view('user.dashboard', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));
    }
}
