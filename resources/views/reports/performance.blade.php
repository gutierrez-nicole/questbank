@extends('layouts.app', ['title' => 'CE Performance Reports'])

@section('content')
<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">Subject Strengths</div>
            <div class="list-group list-group-flush">
                @forelse($strengths as $subject)
                    <div class="list-group-item d-flex justify-content-between">
                        <span>{{ $subject->code }} - {{ $subject->name }}</span>
                        <strong>{{ $subject->average_percentage }}%</strong>
                    </div>
                @empty
                    <div class="list-group-item text-muted">No strength pattern available yet.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">Subject Weaknesses</div>
            <div class="list-group list-group-flush">
                @forelse($weaknesses as $subject)
                    <div class="list-group-item d-flex justify-content-between">
                        <span>{{ $subject->code }} - {{ $subject->name }}</span>
                        <strong>{{ $subject->average_percentage }}%</strong>
                    </div>
                @empty
                    <div class="list-group-item text-muted">No weakness pattern available yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <div class="fw-semibold">Civil Engineering Subject Performance</div>
        <small class="text-muted">Based on recorded examination, quiz, activity, and overall performance records. AI prediction is reserved for a future phase.</small>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject</th>
                    <th>Records</th>
                    <th>Average</th>
                    <th>Interpretation</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjectPerformance as $subject)
                    <tr>
                        <td>{{ $subject->code }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->records_count }}</td>
                        <td>{{ $subject->average_percentage }}%</td>
                        <td>
                            @if($subject->average_percentage >= 85)
                                <span class="badge text-bg-success">Strength</span>
                            @elseif($subject->average_percentage < 75)
                                <span class="badge text-bg-danger">Weakness</span>
                            @else
                                <span class="badge text-bg-secondary">Satisfactory</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-muted">No performance records available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
