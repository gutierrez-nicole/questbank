@extends('layouts.app', ['title' => $user->exists ? 'Edit Account' : 'Register Account'])

@section('content')
<form method="POST" action="{{ $user->exists ? route('accounts.update', $user) : route('accounts.store') }}" class="card border-0 shadow-sm">
    @csrf
    @if($user->exists) @method('PUT') @endif
    <div class="card-body row g-3">
        <div class="col-md-6"><label class="form-label">Full Name</label><input class="form-control" name="name" value="{{ old('name', $user->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Email Address</label><input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
        <div class="col-md-6"><label class="form-label">Username</label><input class="form-control" name="username" value="{{ old('username', $user->username) }}" required></div>
        <div class="col-md-6"><label class="form-label">Role</label><select class="form-select" name="role_id" required>@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>{{ $role->display_name }}</option>@endforeach</select></div>
        <div class="col-md-6"><label class="form-label">Password</label><input class="form-control" type="password" name="password" @required(! $user->exists)></div>
        <div class="col-md-6"><label class="form-label">Confirm Password</label><input class="form-control" type="password" name="password_confirmation" @required(! $user->exists)></div>
        <div class="col-12"><input type="hidden" name="is_active" value="0"><label class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true))> <span class="form-check-label">Active account</span></label></div>
    </div>
    <div class="card-footer bg-white d-flex gap-2"><button class="btn btn-success">Save Account</button><a class="btn btn-outline-secondary" href="{{ route('accounts.index') }}">Cancel</a></div>
</form>
@endsection
