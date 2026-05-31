@extends('layouts.app', ['title' => 'Instructor Management'])
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h4 mb-0">Instructors</h1><a class="btn btn-success" href="{{ route('instructors.create') }}">Add Instructor</a></div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Employee No.</th><th>Name</th><th>Department</th><th>Email</th><th class="text-end">Actions</th></tr></thead><tbody>
@foreach($instructors as $instructor)<tr><td>{{ $instructor->employee_number }}</td><td>{{ $instructor->full_name }}</td><td>{{ $instructor->department }}</td><td>{{ $instructor->email }}</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('instructors.show',$instructor) }}">View</a> <a class="btn btn-sm btn-outline-primary" href="{{ route('instructors.edit',$instructor) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('instructors.destroy',$instructor) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this instructor?')">Delete</button></form></td></tr>@endforeach
</tbody></table></div></div><div class="mt-3">{{ $instructors->links() }}</div>
@endsection
