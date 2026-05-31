@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light px-3 py-4">
    <div class="card border-0 shadow-sm" style="max-width: 620px; width: 100%;">
        <div class="card-body p-4">
            <h1 class="h4 mb-1">Create QuestBank Account</h1>
            <p class="text-muted mb-4">Select the role for the new account.</p>
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('register.store') }}" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input class="form-control" name="username" value="{{ old('username') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role Selection</label>
                    <select class="form-select" name="role_id" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" required>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success">Register</button>
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">Back to login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
