@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4 mb-3">Welcome to the To-Do App</h1>
    <p class="lead mb-4">Manage your daily tasks with ease. Stay organized and productive.</p>

    @guest
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">Get Started</a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Login</a>
    @else
        <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Go to Dashboard</a>
    @endguest
</div>
@endsection
