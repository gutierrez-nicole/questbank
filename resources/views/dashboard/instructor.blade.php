@extends('layouts.app', ['title' => 'Instructor Dashboard'])

@section('content')
<div class="row g-3 mb-4">
    @foreach ([['Subjects Handled', $totalSubjects], ['Exams Created', $totalExams], ['Total Students', $totalStudents]] as [$label, $value])
        <div class="col-md-4"><div class="card stat-card"><div class="card-body"><div class="text-muted">{{ $label }}</div><div class="display-6 fw-semibold">{{ $value }}</div></div></div></div>
    @endforeach
</div>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold">Recent Activities</div>
    <div class="list-group list-group-flush">
        @forelse ($activities as $activity)
            <div class="list-group-item d-flex justify-content-between"><span>{{ $activity->user?->name ?? 'System' }} {{ $activity->description }}</span><small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small></div>
        @empty
            <div class="list-group-item text-muted">No activities recorded.</div>
        @endforelse
    </div>
</div>
@endsection
