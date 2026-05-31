@extends('layouts.app', ['title' => $student->exists ? 'Edit Student' : 'Add Student'])
@section('content')
<form method="POST" action="{{ $student->exists ? route('students.update',$student) : route('students.store') }}" class="card border-0 shadow-sm">@csrf @if($student->exists) @method('PUT') @endif
<div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Linked User</label><select class="form-select" name="user_id"><option value="">None</option>@foreach($users as $user)<option value="{{ $user->id }}" @selected(old('user_id',$student->user_id)==$user->id)>{{ $user->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Student Number</label><input class="form-control" name="student_number" value="{{ old('student_number',$student->student_number) }}" required></div>
<div class="col-md-6"><label class="form-label">Full Name</label><input class="form-control" name="full_name" value="{{ old('full_name',$student->full_name) }}" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email',$student->email) }}"></div>
<div class="col-md-6"><label class="form-label">Program</label><input class="form-control" name="program" value="Civil Engineering" readonly></div>
<div class="col-md-4"><label class="form-label">Year Level</label><input class="form-control" name="year_level" value="{{ old('year_level',$student->year_level) }}"></div>
<div class="col-md-4"><label class="form-label">Section</label><input class="form-control" name="section" value="{{ old('section',$student->section) }}"></div>
<div class="col-md-4"><label class="form-label">Contact Number</label><input class="form-control" name="contact_number" value="{{ old('contact_number',$student->contact_number) }}"></div>
<div class="col-12"><label class="form-label">Address</label><textarea class="form-control" name="address">{{ old('address',$student->address) }}</textarea></div>
</div><div class="card-footer bg-white"><button class="btn btn-success">Save Student</button> <a class="btn btn-outline-secondary" href="{{ route('students.index') }}">Cancel</a></div></form>
@endsection
