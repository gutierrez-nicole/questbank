@extends('layouts.app', ['title' => $instructor->exists ? 'Edit Instructor' : 'Add Instructor'])
@section('content')
<form method="POST" action="{{ $instructor->exists ? route('instructors.update',$instructor) : route('instructors.store') }}" class="card border-0 shadow-sm">@csrf @if($instructor->exists) @method('PUT') @endif
<div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Linked User</label><select class="form-select" name="user_id"><option value="">None</option>@foreach($users as $user)<option value="{{ $user->id }}" @selected(old('user_id',$instructor->user_id)==$user->id)>{{ $user->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Employee Number</label><input class="form-control" name="employee_number" value="{{ old('employee_number',$instructor->employee_number) }}" required></div>
<div class="col-md-6"><label class="form-label">Full Name</label><input class="form-control" name="full_name" value="{{ old('full_name',$instructor->full_name) }}" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email',$instructor->email) }}"></div>
<div class="col-md-6"><label class="form-label">Department</label><input class="form-control" name="department" value="{{ old('department',$instructor->department ?: 'Civil Engineering') }}" required></div>
<div class="col-md-6"><label class="form-label">Position</label><input class="form-control" name="position" value="{{ old('position',$instructor->position) }}" required></div>
<div class="col-md-6"><label class="form-label">Contact Number</label><input class="form-control" name="contact_number" value="{{ old('contact_number',$instructor->contact_number) }}"></div>
</div><div class="card-footer bg-white"><button class="btn btn-success">Save Instructor</button> <a class="btn btn-outline-secondary" href="{{ route('instructors.index') }}">Cancel</a></div></form>
@endsection
