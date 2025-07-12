@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 450px;">
    <h2 class="mb-4 text-center">Forgot Your Password?</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email') }}" 
                required 
                autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </form>
</div>
@endsection
