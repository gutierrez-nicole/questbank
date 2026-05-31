@extends('layouts.app', ['title' => 'Student Dashboard'])

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-6"><div class="card stat-card"><div class="card-body"><div class="text-muted">Exams Available</div><div class="display-6 fw-semibold">{{ $availableExams }}</div></div></div></div>
    <div class="col-md-6"><div class="card stat-card"><div class="card-body"><div class="text-muted">Completed Exams</div><div class="display-6 fw-semibold">{{ $completedExams }}</div></div></div></div>
</div>
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">Recent Scores</div>
            <div class="list-group list-group-flush">
                @forelse ($recentScores as $score)
                    <a class="list-group-item list-group-item-action d-flex justify-content-between" href="{{ route('results.show', $score) }}"><span>{{ $score->examination->title }}</span><strong>{{ $score->percentage }}%</strong></a>
                @empty
                    <div class="list-group-item text-muted">No scores yet.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">Upcoming Exams</div>
            <div class="list-group list-group-flush">
                @forelse ($upcomingExams as $exam)
                    <div class="list-group-item d-flex justify-content-between"><span>{{ $exam->title }} - {{ $exam->subject->name }}</span><small>{{ $exam->scheduled_at?->format('M d, Y h:i A') }}</small></div>
                @empty
                    <div class="list-group-item text-muted">No upcoming exams.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
