@extends('layouts.app', ['title' => 'Results'])
@section('content')
@if(auth()->user()->isRole('student'))
<div class="student-page">
    <div class="student-page-head">
        <div>
            <div class="student-eyebrow">Student Portal</div>
            <h1 class="student-page-title">View <em>Results</em></h1>
            <p class="student-page-sub">Your submitted examination scores and performance records.</p>
        </div>
        <div class="student-chip"><i class="ti ti-chart-bar" aria-hidden="true"></i>{{ $results->total() }} results</div>
    </div>
    <div class="student-card">
        <div class="table-responsive">
            <table class="table student-table align-middle">
                <thead><tr><th>Examination</th><th>Subject</th><th>Score</th><th>Percentage</th><th>Status</th><th class="text-end">Action</th></tr></thead>
                <tbody>
                @forelse($results as $result)
                    @php $pct = $result->percentage; @endphp
                    <tr>
                        <td class="fw-semibold">{{ $result->examination?->title }}</td>
                        <td>{{ $result->examination?->subject?->name }}</td>
                        <td>{{ $result->score }}/{{ $result->total_points }}</td>
                        <td><span class="student-pill {{ $pct >= 75 ? 'green' : 'gold' }}">{{ $pct }}%</span></td>
                        <td><span class="student-pill navy">{{ ucfirst($result->status) }}</span></td>
                        <td class="text-end"><a class="student-action" href="{{ route('results.show',$result) }}"><i class="ti ti-eye" aria-hidden="true"></i> View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted">No results recorded yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $results->links() }}</div>
</div>
@else
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h4 mb-0">Exam Results</h1>@unless(auth()->user()->isRole('student'))<a class="btn btn-success" href="{{ route('results.create') }}">Record Result</a>@endunless</div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Student</th><th>Examination</th><th>Subject</th><th>Score</th><th>Percentage</th><th>Status</th><th class="text-end">Actions</th></tr></thead><tbody>
@foreach($results as $result)<tr><td>{{ $result->student?->full_name }}</td><td>{{ $result->examination?->title }}</td><td>{{ $result->examination?->subject?->name }}</td><td>{{ $result->score }}/{{ $result->total_points }}</td><td>{{ $result->percentage }}%</td><td><span class="badge text-bg-secondary">{{ ucfirst($result->status) }}</span></td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('results.show',$result) }}">View</a> @unless(auth()->user()->isRole('student'))<a class="btn btn-sm btn-outline-primary" href="{{ route('results.edit',$result) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('results.destroy',$result) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this result?')">Delete</button></form>@endunless</td></tr>@endforeach
</tbody></table></div></div><div class="mt-3">{{ $results->links() }}</div>
@endif
@endsection
