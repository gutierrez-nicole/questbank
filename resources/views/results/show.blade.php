@extends('layouts.app', ['title' => 'Exam Result'])
@section('content')
@if(auth()->user()->isRole('student'))
<div class="student-page">
    <div class="student-page-head">
        <div>
            <div class="student-eyebrow">Result Details</div>
            <h1 class="student-page-title">{{ $result->examination->title }}</h1>
            <p class="student-page-sub">Detailed score record for your Civil Engineering examination.</p>
        </div>
        <a class="student-secondary" href="{{ route('results.index') }}"><i class="ti ti-arrow-left" aria-hidden="true"></i> Back to Results</a>
    </div>
    <div class="student-card">
        <div class="student-card-head">
            <h2 class="student-card-title">Score Summary</h2>
            <span class="student-pill {{ $result->percentage >= 75 ? 'green' : 'gold' }}">{{ $result->percentage }}%</span>
        </div>
        <div class="p-3">
            <div class="student-detail-grid">
                <div class="student-detail"><div class="student-detail-label">Student</div><div class="student-detail-value">{{ $result->student->full_name }}</div></div>
                <div class="student-detail"><div class="student-detail-label">Subject</div><div class="student-detail-value">{{ $result->examination->subject->name }}</div></div>
                <div class="student-detail"><div class="student-detail-label">Score</div><div class="student-detail-value">{{ $result->score }} / {{ $result->total_points }}</div></div>
                <div class="student-detail"><div class="student-detail-label">Status</div><div class="student-detail-value">{{ ucfirst($result->status) }}</div></div>
            </div>
            <div class="student-detail mt-3">
                <div class="student-detail-label">Submitted</div>
                <div class="student-detail-value">{{ $result->submitted_at?->format('M d, Y h:i A') ?? 'Not available' }}</div>
            </div>
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm"><div class="card-body"><h1 class="h4">{{ $result->examination->title }}</h1><dl class="row"><dt class="col-sm-3">Student</dt><dd class="col-sm-9">{{ $result->student->full_name }}</dd><dt class="col-sm-3">Subject</dt><dd class="col-sm-9">{{ $result->examination->subject->name }}</dd><dt class="col-sm-3">Score</dt><dd class="col-sm-9">{{ $result->score }} / {{ $result->total_points }}</dd><dt class="col-sm-3">Percentage</dt><dd class="col-sm-9">{{ $result->percentage }}%</dd><dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ ucfirst($result->status) }}</dd><dt class="col-sm-3">Submitted</dt><dd class="col-sm-9">{{ $result->submitted_at?->format('M d, Y h:i A') }}</dd></dl></div><div class="card-footer bg-white"><a class="btn btn-outline-secondary" href="{{ route('results.index') }}">Back</a></div></div>
@endif
@endsection
