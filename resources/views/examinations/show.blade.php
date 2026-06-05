@extends('layouts.app', ['title' => 'Examination Details'])
@section('content')
@if(auth()->user()->isRole('student'))
<div class="student-page">
    <div class="student-page-head">
        <div>
            <div class="student-eyebrow">Examination Preview</div>
            <h1 class="student-page-title">{{ $examination->title }}</h1>
            <p class="student-page-sub">{{ $examination->description ?: 'Review the exam information before starting.' }}</p>
        </div>
        <a class="student-secondary" href="{{ route('examinations.index') }}"><i class="ti ti-arrow-left" aria-hidden="true"></i> Back to Exams</a>
    </div>

    <div class="student-card mb-3">
        <div class="student-card-head">
            <h2 class="student-card-title">Exam Information</h2>
            <span class="student-pill gold">{{ ucfirst($examination->status) }}</span>
        </div>
        <div class="p-3">
            <div class="student-detail-grid">
                <div class="student-detail"><div class="student-detail-label">Subject</div><div class="student-detail-value">{{ $examination->subject->name }}</div></div>
                <div class="student-detail"><div class="student-detail-label">Duration</div><div class="student-detail-value">{{ $examination->duration_minutes }} mins</div></div>
                <div class="student-detail"><div class="student-detail-label">Schedule</div><div class="student-detail-value">{{ $examination->scheduled_at?->format('M d, Y h:i A') ?? 'TBA' }}</div></div>
                <div class="student-detail"><div class="student-detail-label">Passing Score</div><div class="student-detail-value">{{ $examination->passing_score }}%</div></div>
            </div>
        </div>
    </div>

    <div class="student-card">
        <div class="student-card-head">
            <h2 class="student-card-title">Question Overview</h2>
            <span class="student-pill navy">{{ $examination->questions->count() }} questions</span>
        </div>
        <div class="list-group list-group-flush">
            @forelse($examination->questions as $question)
                <div class="list-group-item px-3 py-3">
                    <span class="student-pill gold me-2">{{ ucfirst(str_replace('_',' ',$question->type)) }}</span>
                    {{ $question->question_text }}
                    <span class="student-pill navy ms-2">{{ $question->points }} pt</span>
                </div>
            @empty
                <div class="p-3 text-muted">No questions added.</div>
            @endforelse
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm mb-3"><div class="card-body"><h1 class="h4">{{ $examination->title }}</h1><p class="text-muted">{{ $examination->description }}</p><dl class="row"><dt class="col-sm-3">Subject</dt><dd class="col-sm-9">{{ $examination->subject->name }}</dd><dt class="col-sm-3">Duration</dt><dd class="col-sm-9">{{ $examination->duration_minutes }} minutes</dd><dt class="col-sm-3">Schedule</dt><dd class="col-sm-9">{{ $examination->scheduled_at?->format('M d, Y h:i A') }}</dd><dt class="col-sm-3">Passing Score</dt><dd class="col-sm-9">{{ $examination->passing_score }}%</dd></dl></div></div>
<div class="card border-0 shadow-sm"><div class="card-header bg-white fw-semibold">Questions</div><div class="list-group list-group-flush">@forelse($examination->questions as $question)<div class="list-group-item"><strong>{{ ucfirst(str_replace('_',' ',$question->type)) }}:</strong> {{ $question->question_text }} <span class="badge text-bg-secondary">{{ $question->points }} pt</span></div>@empty<div class="list-group-item text-muted">No questions added.</div>@endforelse</div></div>
@endif
@endsection
