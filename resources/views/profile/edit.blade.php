@extends('layouts.app', ['title' => 'User Profile'])
@section('content')
<div class="row g-3">
    <div class="col-lg-6">
        <form method="POST" action="{{ route('profile.update') }}" class="card border-0 shadow-sm">@csrf @method('PUT')
            <div class="card-header bg-white fw-semibold">Profile Information</div>
            <div class="card-body d-grid gap-3">
                <div><label class="form-label">Full Name</label><input class="form-control" name="name" value="{{ old('name',$user->name) }}" required></div>
                <div><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email',$user->email) }}" required></div>
                <div><label class="form-label">Username</label><input class="form-control" name="username" value="{{ old('username',$user->username) }}" required></div>
            </div>
            <div class="card-footer bg-white"><button class="btn btn-success">Save Profile</button></div>
        </form>
    </div>
    <div class="col-lg-6">
        <form method="POST" action="{{ route('profile.password') }}" class="card border-0 shadow-sm">@csrf @method('PUT')
            <div class="card-header bg-white fw-semibold">Change Password</div>
            <div class="card-body d-grid gap-3">
                <div><label class="form-label">Current Password</label><input class="form-control" type="password" name="current_password" required></div>
                <div><label class="form-label">New Password</label><input class="form-control" type="password" name="password" required></div>
                <div><label class="form-label">Confirm New Password</label><input class="form-control" type="password" name="password_confirmation" required></div>
            </div>
            <div class="card-footer bg-white"><button class="btn btn-success">Change Password</button></div>
        </form>
    </div>
</div>
@endsection
