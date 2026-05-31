@extends('layouts.app', ['title' => 'Question Bank'])
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h4 mb-0">Questions</h1><a class="btn btn-success" href="{{ route('questions.create') }}">Add Question</a></div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Examination</th><th>Type</th><th>Question</th><th>Points</th><th class="text-end">Actions</th></tr></thead><tbody>
@foreach($questions as $question)<tr><td>{{ $question->examination?->title }}</td><td>{{ ucfirst(str_replace('_',' ',$question->type)) }}</td><td>{{ Str::limit($question->question_text, 80) }}</td><td>{{ $question->points }}</td><td class="text-end"><a class="btn btn-sm btn-outline-primary" href="{{ route('questions.edit',$question) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('questions.destroy',$question) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this question?')">Delete</button></form></td></tr>@endforeach
</tbody></table></div></div><div class="mt-3">{{ $questions->links() }}</div>
@endsection
