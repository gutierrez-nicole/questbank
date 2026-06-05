@extends('layouts.app', ['title' => 'Examination Management'])

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<style>
    :root {
        --navy:      #0c2340;
        --navy2:     #1a3a5c;
        --gold:      #e8b84b;
        --gold-dim:  #c9922a;
        --gold-pale: #fdf3db;
        --cream:     #f7f3ec;
        --cream2:    #e0d8c8;
        --cream3:    #f0ebe1;
        --ink:       #1a1a16;
        --muted:     #7a7060;
        --hint:      #b0a890;
        --border:    rgba(0,0,0,.07);
        --success:   #1a6b45;
        --success-bg:#e8f5ee;
    }

    body {
        font-family: 'Sora', sans-serif;
        background: var(--cream);
        color: var(--ink);
        margin: 0;
    }

    .qb-topbar {
        background: var(--navy);
        padding: 0 28px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .qb-topbar::after {
        content: '';
        position: absolute;
        right: -60px; top: -60px;
        width: 200px; height: 200px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.06);
        pointer-events: none;
    }

    .qb-topbar::before {
        content: '';
        position: absolute;
        right: 60px; bottom: -80px;
        width: 160px; height: 160px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.05);
        pointer-events: none;
    }

    .qb-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .qb-brand-logo {
        width: 32px; height: 32px;
        background: #fff;
        border-radius: 50%;
        border: 2px solid rgba(232,184,75,.8);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .qb-brand-logo img {
        width: 28px; height: 28px;
        border-radius: 50%;
        object-fit: cover;
    }

    .qb-brand-name {
        font-family: 'Playfair Display', serif;
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: -.3px;
    }

    .qb-brand-name span {
        color: var(--gold);
        font-style: italic;
        font-weight: 400;
    }

    .qb-nav {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .qb-nav-item {
        padding: 6px 14px;
        border-radius: 6px;
        font-size: .7rem;
        font-weight: 500;
        color: rgba(255,255,255,.65);
        text-decoration: none;
        transition: all .15s;
        display: flex;
        align-items: center;
        gap: 6px;
        letter-spacing: .2px;
    }

    .qb-nav-item.active,
    .qb-nav-item:hover {
        background: rgba(255,255,255,.12);
        color: #fff;
    }

    .qb-topbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .qb-notif {
        width: 30px; height: 30px;
        border-radius: 8px;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        transition: background .15s;
        color: #fff;
    }

    .qb-notif:hover { background: rgba(255,255,255,.13); }

    .qb-notif-dot {
        position: absolute;
        top: 7px; right: 7px;
        width: 6px; height: 6px;
        background: var(--gold);
        border-radius: 50%;
        border: 1.5px solid var(--navy);
    }

    .qb-avatar {
        width: 34px; height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--gold-dim));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        font-weight: 700;
        color: #fff;
        border: 2px solid rgba(232,184,75,.4);
        letter-spacing: .5px;
    }

    .qb-body { 
        padding: 28px 32px;
        max-width: 1600px;
        margin: 0 auto;
    }

    .qb-page-head {
        margin-bottom: 22px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .qb-eyebrow {
        font-size: .58rem;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        color: var(--gold-dim);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .qb-page-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    .qb-page-sub {
        font-size: .78rem;
        color: var(--muted);
        margin-top: 6px;
        letter-spacing: 0.3px;
    }

    .qb-date-badge {
        background: #fff;
        border: 1px solid var(--cream2);
        border-radius: 8px;
        padding: 7px 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: .7rem;
        color: var(--muted);
        flex-shrink: 0;
    }

    .qb-date-badge strong { color: var(--navy); font-weight: 600; }

    .qb-stat-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 20px;
    }

    .qb-stat {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px 22px;
        position: relative;
        overflow: hidden;
        animation: qbFade .4s ease both;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all .2s;
    }

    .qb-stat:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-color: var(--gold-pale);
    }

    .qb-stat-bar {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 14px 14px 0 0;
    }

    .qb-stat-bar.navy { background: linear-gradient(90deg, var(--navy) 0%, var(--gold) 100%); }
    .qb-stat-bar.gold { background: linear-gradient(90deg, var(--gold) 0%, var(--gold-dim) 100%); }

    .qb-stat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .qb-stat-icon {
        width: 34px; height: 34px;
        border-radius: 9px;
        background: var(--gold-pale);
        border: 1px solid rgba(232,184,75,.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold-dim);
    }

    .qb-stat-label {
        font-size: .62rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: var(--hint);
        margin-bottom: 8px;
    }

    .qb-stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1;
        margin-bottom: 8px;
    }

    .qb-stat-desc {
        font-size: .7rem;
        color: var(--hint);
        line-height: 1.4;
    }

    .qb-panels {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 16px;
    }

    .qb-panel {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        animation: qbFade .4s ease both;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: box-shadow .2s;
    }

    .qb-panel:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .qb-panel-head {
        padding: 16px 18px;
        border-bottom: 2px solid var(--cream3);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, rgba(12, 35, 64, 0.02) 0%, rgba(232, 184, 75, 0.02) 100%);
    }

    .qb-panel-head-left {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .qb-panel-icon {
        width: 28px; height: 28px;
        border-radius: 7px;
        background: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex-shrink: 0;
    }

    .qb-panel-title {
        font-size: .85rem;
        font-weight: 700;
        color: var(--ink);
        letter-spacing: 0.3px;
    }

    .qb-panel-badge {
        font-size: .58rem;
        font-weight: 600;
        letter-spacing: .6px;
        color: var(--muted);
        background: var(--cream);
        border: 1px solid var(--cream2);
        border-radius: 20px;
        padding: 2px 9px;
    }

    .qb-score-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--cream);
        text-decoration: none;
        color: inherit;
    }

    .qb-score-item:last-child { border-bottom: none; }

    .qb-score-name {
        flex: 1;
        font-size: .77rem;
        font-weight: 500;
        color: var(--ink);
    }

    .qb-score-time {
        font-size: .68rem;
        color: var(--muted);
        white-space: nowrap;
    }

    .qb-pill {
        font-size: .66rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 4px 10px;
        background: var(--gold-pale);
        color: #92521a;
        flex-shrink: 0;
    }

    .qb-empty {
        padding: 28px 20px;
        text-align: center;
        color: var(--hint);
        font-size: .74rem;
    }

    .qb-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
    }

    .qb-table thead th {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
        color: #fff;
        border-bottom: 2px solid var(--gold);
        font-weight: 700;
        padding: 16px 14px;
        text-align: left;
        font-size: .8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .qb-table th:nth-child(1) { min-width: 180px; }
    .qb-table th:nth-child(2) { min-width: 140px; }
    .qb-table th:nth-child(3),
    .qb-table th:nth-child(4) { min-width: 100px; }
    .qb-table th:nth-child(5),
    .qb-table th:nth-child(6) { min-width: 90px; }
    .qb-table th:nth-child(7) { min-width: 120px; text-align: right; }

    .qb-table tbody tr {
        border-bottom: 1px solid var(--cream3);
        transition: background-color .2s;
    }

    .qb-table tbody tr:hover {
        background-color: var(--cream3);
    }

    .qb-table tbody td {
        padding: 16px 14px;
        vertical-align: middle;
        font-size: .85rem;
    }

    .qb-table tbody td:nth-child(1) {
        font-weight: 600;
        color: var(--navy);
    }

    .qb-table tbody td:nth-child(4) {
        font-size: .82rem;
        color: var(--muted);
    }

    .qb-table .badge {
        font-size: .75rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
    }

    .qb-table .badge.text-bg-info {
        background: var(--success-bg) !important;
        color: var(--success) !important;
    }

    .qb-actions {
        text-align: right;
    }

    .qb-actions .btn,
    .qb-actions .dropdown-toggle {
        font-size: .8rem;
        padding: .4rem .7rem;
        border-radius: 6px;
        white-space: nowrap;
    }

    .qb-actions .dropdown-menu { 
        min-width: 140px;
        font-size: .85rem;
    }

    .qb-actions .dropdown-menu .dropdown-item {
        padding: .5rem .9rem;
    }

    .qb-page-footer {
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 0;
    }

    .qb-page-footer .page-count { 
        color: var(--muted); 
        font-size: .8rem;
        font-weight: 500;
    }

    @keyframes qbFade {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .qb-panel .table-responsive {
        overflow-x: auto;
        border-top: 1px solid var(--cream3);
    }

    @media (max-width: 900px) {
        .qb-nav { display: none; }
        .qb-stat-grid { grid-template-columns: 1fr; }
        .qb-panels { grid-template-columns: 1fr; }
        .qb-body { padding: 20px 16px; }
    }
</style>
@endsection

@section('content')
@if(auth()->user()->isRole('student'))
<div class="student-page">
    <div class="student-page-head">
        <div>
            <div class="student-eyebrow">Student Portal</div>
            <h1 class="student-page-title">Take <em>Examinations</em></h1>
            <p class="student-page-sub">Available Civil Engineering examinations for your account.</p>
        </div>
        <div class="student-chip"><i class="ti ti-file-text" aria-hidden="true"></i>{{ $examinations->total() }} exams listed</div>
    </div>
    <div class="student-card">
        <div class="table-responsive">
            <table class="table student-table align-middle">
                <thead><tr><th>Title</th><th>Subject</th><th>Duration</th><th>Schedule</th><th>Passing</th><th>Status</th><th class="text-end">Action</th></tr></thead>
                <tbody>
                @forelse($examinations as $exam)
                    <tr>
                        <td class="fw-semibold">{{ $exam->title }}</td>
                        <td>{{ $exam->subject?->name }}</td>
                        <td>{{ $exam->duration_minutes }} mins</td>
                        <td>{{ $exam->scheduled_at?->format('M d, Y h:i A') ?? 'TBA' }}</td>
                        <td><span class="student-pill gold">{{ $exam->passing_score }}%</span></td>
                        <td><span class="student-pill navy">{{ ucfirst($exam->status) }}</span></td>
                        <td class="text-end"><a class="student-action" href="{{ route('examinations.show',$exam) }}"><i class="ti ti-player-play" aria-hidden="true"></i> Start</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted">No examinations available.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="qb-page-footer">
        <div class="page-count">Showing {{ $examinations->count() }} of {{ $examinations->total() }} examinations</div>
        <div>{{ $examinations->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@else
@php
    $publishedCount = $examinations->where('status', 'published')->count();
    $scheduledCount = $examinations->whereNotNull('scheduled_at')->count();
    $draftCount = $examinations->total() - $publishedCount;
@endphp

<div class="qb-topbar">
    <a href="{{ route('dashboard') }}" class="qb-brand">
        <div class="qb-brand-logo">
            <img src="{{ asset('images/logo.png') }}" alt="QuestBank" onerror="this.style.display='none';this.parentElement.innerHTML='Q'">
        </div>
        <div class="qb-brand-name">Quest<span>Bank</span></div>
    </a>
    <div class="qb-nav">
        <a href="{{ route('examinations.index') }}" class="qb-nav-item active"><i class="ti ti-file-text"></i> Examinations</a>
        <a href="{{ route('questions.index') }}" class="qb-nav-item"><i class="ti ti-book"></i> Question Bank</a>
        <a href="{{ route('results.index') }}" class="qb-nav-item"><i class="ti ti-chart-bar"></i> Results</a>
    </div>
    <div class="qb-topbar-right">
        <div class="qb-notif"><i class="ti ti-bell"></i><span class="qb-notif-dot"></span></div>
        <div class="qb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
    </div>
</div>

<div class="qb-body">
    <div class="qb-page-head">
        <div>
            <div class="qb-eyebrow">Instructor Portal</div>
            <div class="qb-page-title">Examinations</div>
            <div class="qb-page-sub">Create, review, and manage examinations from the dashboard.</div>
        </div>
        <div class="qb-date-badge"><strong>{{ now()->format('M j') }}</strong> {{ now()->format('l, Y') }}</div>
    </div>

    <div class="qb-stat-grid">
        <div class="qb-stat">
            <div class="qb-stat-bar navy"></div>
            <div class="qb-stat-top">
                <div>
                    <div class="qb-stat-label">Total Exams</div>
                    <div class="qb-stat-num">{{ $examinations->total() }}</div>
                </div>
                <div class="qb-stat-icon"><i class="ti ti-file-list"></i></div>
            </div>
            <div class="qb-stat-desc">Full count of all examinations available for management.</div>
        </div>
        <div class="qb-stat">
            <div class="qb-stat-bar gold"></div>
            <div class="qb-stat-top">
                <div>
                    <div class="qb-stat-label">Published</div>
                    <div class="qb-stat-num">{{ $publishedCount }}</div>
                </div>
                <div class="qb-stat-icon"><i class="ti ti-check"></i></div>
            </div>
            <div class="qb-stat-desc">Exams ready for students to take.</div>
        </div>
        <div class="qb-stat">
            <div class="qb-stat-bar navy"></div>
            <div class="qb-stat-top">
                <div>
                    <div class="qb-stat-label">Scheduled</div>
                    <div class="qb-stat-num">{{ $scheduledCount }}</div>
                </div>
                <div class="qb-stat-icon"><i class="ti ti-calendar"></i></div>
            </div>
            <div class="qb-stat-desc">Exams with assigned schedule dates.</div>
        </div>
    </div>

    <div class="qb-panels">
        <div class="qb-panel">
            <div class="qb-panel-head">
                <div class="qb-panel-head-left">
                    <div class="qb-panel-icon"><i class="ti ti-list-check"></i></div>
                    <div>
                        <div class="qb-panel-title">Exam List</div>
                        <div class="qb-panel-badge">Manage exams and actions</div>
                    </div>
                </div>
                <div class="qb-panel-badge">{{ $examinations->count() }} shown</div>
            </div>
            <div class="table-responsive">
                <table class="table qb-table mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Duration</th>
                            <th>Schedule</th>
                            <th>Passing</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($examinations as $exam)
                            <tr>
                                <td>{{ $exam->title }}</td>
                                <td>{{ $exam->subject?->name }}</td>
                                <td>{{ $exam->duration_minutes }} mins</td>
                                <td>{{ $exam->scheduled_at?->format('M d, Y h:i A') ?? 'TBA' }}</td>
                                <td>{{ $exam->passing_score }}%</td>
                                <td><span class="badge text-bg-info">{{ ucfirst($exam->status) }}</span></td>
                                <td class="text-end qb-actions">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('examinations.show',$exam) }}">View</a></li>
                                            <li><a class="dropdown-item" href="{{ route('examinations.edit',$exam) }}">Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form method="POST" action="{{ route('examinations.destroy',$exam) }}" onsubmit="return confirm('Delete this examination?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="qb-panel">
            <div class="qb-panel-head">
                <div class="qb-panel-head-left">
                    <div class="qb-panel-icon"><i class="ti ti-rocket"></i></div>
                    <div>
                        <div class="qb-panel-title">Quick Actions</div>
                        <div class="qb-panel-badge">Fast access</div>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="list-group">
                    <a href="{{ route('examinations.create') }}" class="list-group-item list-group-item-action">Create New Examination</a>
                    <a href="{{ route('questions.index') }}" class="list-group-item list-group-item-action">Go to Question Bank</a>
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $examinations->links() }}</div>
</div>
@endif
@endsection
