@extends('layouts.app', ['title' => $user->exists ? 'Edit Account' : 'Register Account'])

@section('content')
<div class="{{ auth()->user()->isRole('student') ? 'student-page' : '' }}">
@if(auth()->user()->isRole('student'))
    <div class="student-page-head">
        <div>
            <div class="student-eyebrow">Student Portal</div>
            <h1 class="student-page-title">Register New <em>Account</em></h1>
            <p class="student-page-sub">Create another student account for QuestBank access.</p>
        </div>
        <a class="student-secondary" href="{{ route('dashboard') }}"><i class="ti ti-arrow-left" aria-hidden="true"></i> Back to Dashboard</a>
    </div>
@endif
<form method="POST" action="{{ $user->exists ? route('accounts.update', $user) : route('accounts.store') }}" class="card border-0 shadow-sm {{ auth()->user()->isRole('student') ? 'student-form-card' : '' }}">
    @csrf
    @if($user->exists) @method('PUT') @endif
    <div class="card-body row g-3">
        <div class="col-md-6"><label class="form-label">Full Name</label><input class="form-control" name="name" value="{{ old('name', $user->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Email Address</label><input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
        <div class="col-md-6"><label class="form-label">Username</label><input class="form-control" name="username" value="{{ old('username', $user->username) }}" required></div>
        <div class="col-md-6"><label class="form-label">Role</label><select id="account_role_id" class="form-select" name="role_id" required>@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>{{ $role->display_name }}</option>@endforeach</select></div>
        <div id="account-student-fields" class="col-12" style="display:none;">
            <div class="row g-3">
                <div class="col-md-6 student-role"><label class="form-label">Student ID Number</label><input class="form-control" name="student_number" value="{{ old('student_number', $user->student?->student_number) }}"></div>
                <div class="col-md-3 student-role"><label class="form-label">Year Level</label><input class="form-control" name="year_level" value="{{ old('year_level', $user->student?->year_level) }}"></div>
                <div class="col-md-3 student-role"><label class="form-label">Section</label><input class="form-control" name="section" value="{{ old('section', $user->student?->section) }}"></div>
                <div class="col-md-12 student-role"><label class="form-label">Course</label><input class="form-control" name="program" value="Bachelor of Science in Civil Engineering (BSCE)" readonly></div>
            </div>
        </div>
        <div id="account-instructor-fields" class="col-12" style="display:none;">
            <div class="row g-3">
                <div class="col-md-6 instructor-role"><label class="form-label">Employee ID Number</label><input class="form-control" name="employee_number" value="{{ old('employee_number', $user->instructor?->employee_number) }}"></div>
                <div class="col-md-6 instructor-role"><label class="form-label">Department</label><input class="form-control" name="department" value="{{ old('department', $user->instructor?->department ?: 'Civil Engineering') }}"></div>
                <div class="col-md-6 instructor-role"><label class="form-label">Position</label><input class="form-control" name="position" value="{{ old('position', $user->instructor?->position) }}"></div>
            </div>
        </div>
        <div class="col-md-6"><label class="form-label">Password</label><input class="form-control" type="password" name="password" @required(! $user->exists)></div>
        <div class="col-md-6"><label class="form-label">Confirm Password</label><input class="form-control" type="password" name="password_confirmation" @required(! $user->exists)></div>
        <div class="col-12"><input type="hidden" name="is_active" value="0"><label class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true))> <span class="form-check-label">Active account</span></label></div>
    </div>
    <div class="card-footer bg-white d-flex gap-2"><button class="btn btn-success">Save Account</button><a class="btn btn-outline-secondary" href="{{ route('accounts.index') }}">Cancel</a></div>
</form>
<script>
function setAccountRoleFields() {
    const roleSelect = document.getElementById('account_role_id');
    const roleName = roleSelect.selectedOptions[0]?.text || '';
    const showStudent = roleName === 'Student';
    const showInstructor = roleName === 'Instructor';

    document.getElementById('account-student-fields').style.display = showStudent ? 'block' : 'none';
    document.getElementById('account-instructor-fields').style.display = showInstructor ? 'block' : 'none';

    document.querySelectorAll('.student-role input, .student-role select').forEach(input => input.disabled = !showStudent);
    document.querySelectorAll('.instructor-role input, .instructor-role select').forEach(input => input.disabled = !showInstructor);
}

document.getElementById('account_role_id').addEventListener('change', setAccountRoleFields);
setAccountRoleFields();
</script>
</div>
@endsection
