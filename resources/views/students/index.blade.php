@extends('layouts.app', ['title' => 'Student Management'])
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h4 mb-0">Students</h1><a class="btn btn-success" href="{{ route('students.create') }}">Add Student</a></div>
<form class="mb-3"><div class="input-group"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search students"><button class="btn btn-outline-secondary">Search</button></div></form>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Student No.</th><th>Name</th><th>Year</th><th>Section</th><th>Email</th><th class="text-end">Actions</th></tr></thead><tbody>
@foreach($students as $student)<tr><td>{{ $student->student_number }}</td><td>{{ $student->full_name }}</td><td>{{ $student->year_level }}</td><td>{{ $student->section }}</td><td>{{ $student->email }}</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('students.show',$student) }}">View</a> <a class="btn btn-sm btn-outline-primary" href="{{ route('students.edit',$student) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('students.destroy',$student) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this student?')">Delete</button></form></td></tr>@endforeach
</tbody></table></div></div><div class="mt-3">{{ $students->links() }}</div>
@endsection
