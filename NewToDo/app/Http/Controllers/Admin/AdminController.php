<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with statistics, recent users, and tasks.
     */
    public function dashboard()
    {
        // Count statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'Completed')->count();
        $pendingTasks = Task::where('status', 'Pending')->count();

        // Latest 5 users and tasks
        $users = User::where('role', 'user')->latest()->paginate(5);
        $tasks = Task::with('user')->latest()->paginate(5);

        // Pass data to the view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'users',
            'tasks'
        ));
    }
}
