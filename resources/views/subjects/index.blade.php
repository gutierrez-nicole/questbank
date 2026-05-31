@extends('layouts.app', ['title' => 'Subject Management'])
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h4 mb-0">Subjects</h1><a class="btn btn-success" href="{{ route('subjects.create') }}">Add Subject</a></div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Code</th><th>Name</th><th>Instructor</th><th>Units</th><th class="text-end">Actions</th></tr></thead><tbody>
@foreach($subjects as $subject)<tr><td>{{ $subject->code }}</td><td>{{ $subject->name }}</td><td>{{ $subject->instructor?->full_name ?? 'Unassigned' }}</td><td>{{ $subject->units }}</td><td class="text-end"><a class="btn btn-sm btn-outline-primary" href="{{ route('subjects.edit',$subject) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('subjects.destroy',$subject) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this subject?')">Delete</button></form></td></tr>@endforeach
</tbody></table></div></div><div class="mt-3">{{ $subjects->links() }}</div>
@endsection
