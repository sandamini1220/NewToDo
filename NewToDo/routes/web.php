<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing page (public)
Route::get('/', function () {
    return view('welcome');
});

// Redirect after login based on user role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Default to user dashboard
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// User-only routes
Route::middleware(['auth', 'role:user'])->group(function () {
    // User dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Tasks CRUD routes for user
    Route::resource('tasks', TaskController::class);
});

// Profile management for authenticated users (both admin and user)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (Breeze, Jetstream, or Laravel UI)
require __DIR__.'/auth.php';
