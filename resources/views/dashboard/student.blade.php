@extends('layouts.app', ['title' => 'Student Dashboard'])

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

    /* ══ Top Nav Bar ══ */
    .qb-topbar {
        background: var(--navy);
        padding: 0 28px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
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
        color: rgba(255,255,255,.5);
        text-decoration: none;
        transition: all .15s;
        display: flex;
        align-items: center;
        gap: 6px;
        letter-spacing: .2px;
    }

    .qb-nav-item.active, .qb-nav-item:hover {
        background: rgba(255,255,255,.1);
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
        width: 30px; height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--gold-dim));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .62rem;
        font-weight: 600;
        color: #fff;
        border: 2px solid rgba(232,184,75,.4);
        cursor: pointer;
        letter-spacing: .5px;
    }

    /* ══ Body ══ */
    .qb-body { padding: 24px 28px; }

    /* ── Page Header ── */
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
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.2;
    }

    .qb-page-title em {
        color: var(--gold-dim);
        font-style: italic;
    }

    .qb-page-sub {
        font-size: .72rem;
        color: var(--muted);
        margin-top: 3px;
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

    /* ── Stat Cards ── */
    .qb-stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 20px;
    }

    .qb-stat {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px 20px;
        position: relative;
        overflow: hidden;
        animation: qbFade .4s ease both;
    }

    .qb-stat:nth-child(1) { animation-delay: .05s; }
    .qb-stat:nth-child(2) { animation-delay: .1s; }

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
    }

    .qb-stat-trend {
        font-size: .62rem;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .qb-stat-trend.up   { background: var(--success-bg); color: var(--success); }
    .qb-stat-trend.muted{ background: var(--cream);      color: var(--muted); }

    .qb-stat-label {
        font-size: .58rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--hint);
        margin-bottom: 5px;
    }

    .qb-stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1;
    }

    .qb-stat-desc {
        font-size: .66rem;
        color: var(--hint);
        margin-top: 4px;
    }

    .qb-stat-progress {
        margin-top: 14px;
        height: 3px;
        background: var(--cream);
        border-radius: 3px;
        overflow: hidden;
    }

    .qb-stat-progress-fill {
        height: 100%;
        border-radius: 3px;
        background: linear-gradient(90deg, var(--navy), var(--gold));
    }

    /* ── Panels ── */
    .qb-panels {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .qb-panel {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        animation: qbFade .4s ease both;
    }

    .qb-panel:nth-child(1) { animation-delay: .18s; }
    .qb-panel:nth-child(2) { animation-delay: .24s; }

    .qb-panel-head {
        padding: 14px 18px;
        border-bottom: 1px solid var(--cream3);
        display: flex;
        align-items: center;
        justify-content: space-between;
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
        flex-shrink: 0;
    }

    .qb-panel-title {
        font-size: .75rem;
        font-weight: 600;
        color: var(--ink);
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

    /* Score rows */
    .qb-score-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 18px;
        border-bottom: 1px solid var(--cream);
        text-decoration: none;
        color: inherit;
        transition: background .12s;
    }

    .qb-score-item:last-child { border-bottom: none; }
    .qb-score-item:hover { background: #faf8f4; }

    .qb-score-rank {
        width: 22px; height: 22px;
        border-radius: 50%;
        background: var(--cream);
        border: 1px solid var(--cream2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .58rem;
        font-weight: 600;
        color: var(--muted);
        flex-shrink: 0;
    }

    .qb-score-name {
        flex: 1;
        font-size: .76rem;
        font-weight: 500;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .qb-score-sub {
        font-size: .62rem;
        color: var(--hint);
        margin-top: 1px;
    }

    .qb-pill {
        font-size: .66rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 3px 10px;
        flex-shrink: 0;
    }

    .qb-pill.high { background: var(--success-bg); color: var(--success); }
    .qb-pill.mid  { background: var(--gold-pale);  color: #92521a; }
    .qb-pill.low  { background: #fef2f2;            color: #b91c1c; }

    /* Exam rows */
    .qb-exam-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 18px;
        border-bottom: 1px solid var(--cream);
    }

    .qb-exam-item:last-child { border-bottom: none; }

    .qb-exam-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: var(--gold);
        box-shadow: 0 0 0 3px rgba(232,184,75,.15);
        flex-shrink: 0;
    }

    .qb-exam-info { flex: 1; min-width: 0; }

    .qb-exam-name {
        font-size: .76rem;
        font-weight: 500;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .qb-exam-subject {
        font-size: .62rem;
        color: var(--hint);
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .qb-exam-date { text-align: right; flex-shrink: 0; }
    .qb-exam-day  { font-size: .7rem; font-weight: 600; color: var(--navy); }
    .qb-exam-time { font-size: .6rem; color: var(--hint); }

    .qb-exam-chip {
        font-size: .58rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 5px;
        background: var(--gold-pale);
        color: #92521a;
        border: 1px solid rgba(232,184,75,.25);
    }

    /* Empty state */
    .qb-empty {
        padding: 28px 20px;
        text-align: center;
        color: var(--hint);
        font-size: .74rem;
    }

    .qb-empty i {
        display: block;
        font-size: 28px;
        margin: 0 auto 10px;
        opacity: .4;
    }

    /* Animation */
    @keyframes qbFade {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 900px) {
        .qb-nav { display: none; }
    }

    @media (max-width: 720px) {
        .qb-body { padding: 18px 16px; }
        .qb-stat-grid, .qb-panels { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

{{-- ══ Top Nav Bar ══ --}}
<nav class="qb-topbar">
    <a href="{{ route('dashboard') }}" class="qb-brand">
        <div class="qb-brand-logo">
            <img src="{{ asset('images/logo.png') }}" alt="HCC"
                 onerror="this.style.display='none';this.parentElement.innerHTML='Q'">
        </div>
        <div class="qb-brand-name">Quest<span>Bank</span></div>
    </a>

    <div class="qb-nav">
        <a href="{{ route('dashboard') }}" class="qb-nav-item active">
            <i class="ti ti-layout-dashboard" aria-hidden="true"></i> Dashboard
        </a>
        <a href="{{ route('examinations.index') }}" class="qb-nav-item">
            <i class="ti ti-file-text" aria-hidden="true"></i> Exams
        </a>
        <a href="{{ route('results.index') }}" class="qb-nav-item">
            <i class="ti ti-chart-bar" aria-hidden="true"></i> Results
        </a>
    </div>

    <div class="qb-topbar-right">
        <div class="qb-notif" title="Notifications">
            <i class="ti ti-bell" style="font-size:14px;color:rgba(255,255,255,.6)" aria-hidden="true"></i>
            <div class="qb-notif-dot"></div>
        </div>
        <div class="qb-avatar" title="{{ auth()->user()->name }}">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
        </div>
    </div>
</nav>

{{-- ══ Page Body ══ --}}
<div class="qb-body">

    {{-- Page Header --}}
    <div class="qb-page-head">
        <div>
            <div class="qb-eyebrow">Student Portal</div>
            <h1 class="qb-page-title">
                Welcome back, <em>{{ auth()->user()->name }}</em>
            </h1>
            <p class="qb-page-sub">Here's a snapshot of your examination activity.</p>
        </div>
        <div class="qb-date-badge">
            <i class="ti ti-calendar" style="font-size:14px;color:var(--gold-dim)" aria-hidden="true"></i>
            <span><strong>{{ now()->format('M d') }}</strong>, {{ now()->format('Y') }} · 2nd Semester</span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="qb-stat-grid">

        <div class="qb-stat">
            <div class="qb-stat-bar navy"></div>
            <div class="qb-stat-top">
                <div class="qb-stat-icon">
                    <i class="ti ti-file-description" style="font-size:16px;color:var(--gold-dim)" aria-hidden="true"></i>
                </div>
                <div class="qb-stat-trend muted">
                    <i class="ti ti-clock" style="font-size:11px" aria-hidden="true"></i> Active
                </div>
            </div>
            <div class="qb-stat-label">Exams Available</div>
            <div class="qb-stat-num">{{ $availableExams }}</div>
            <div class="qb-stat-desc">Ready to take this semester</div>
            @if ($availableExams > 0)
            <div class="qb-stat-progress">
                <div class="qb-stat-progress-fill" style="width:{{ min(100, ($completedExams / max(1,$availableExams)) * 100) }}%"></div>
            </div>
            @endif
        </div>

        <div class="qb-stat">
            <div class="qb-stat-bar gold"></div>
            <div class="qb-stat-top">
                <div class="qb-stat-icon">
                    <i class="ti ti-circle-check" style="font-size:16px;color:var(--gold-dim)" aria-hidden="true"></i>
                </div>
                <div class="qb-stat-trend up">
                    <i class="ti ti-trending-up" style="font-size:11px" aria-hidden="true"></i> Submitted
                </div>
            </div>
            <div class="qb-stat-label">Completed Exams</div>
            <div class="qb-stat-num">{{ $completedExams }}</div>
            <div class="qb-stat-desc">Submitted &amp; graded</div>
            @if ($availableExams > 0)
            <div class="qb-stat-progress">
                <div class="qb-stat-progress-fill" style="width:{{ min(100, ($completedExams / max(1,$availableExams)) * 100) }}%"></div>
            </div>
            @endif
        </div>

    </div>

    {{-- Panels --}}
    <div class="qb-panels">

        {{-- Recent Scores --}}
        <div class="qb-panel">
            <div class="qb-panel-head">
                <div class="qb-panel-head-left">
                    <div class="qb-panel-icon">
                        <i class="ti ti-trending-up" style="font-size:13px;color:var(--gold)" aria-hidden="true"></i>
                    </div>
                    <span class="qb-panel-title">Recent Scores</span>
                </div>
                <span class="qb-panel-badge">{{ $recentScores->count() }} records</span>
            </div>

            @forelse ($recentScores as $i => $score)
                @php
                    $pct = $score->percentage;
                    $cls = $pct >= 75 ? 'high' : ($pct >= 50 ? 'mid' : 'low');
                @endphp
                <a class="qb-score-item" href="{{ route('results.show', $score) }}">
                    <div class="qb-score-rank">{{ $i + 1 }}</div>
                    <div style="flex:1;min-width:0">
                        <div class="qb-score-name">{{ $score->examination->title }}</div>
                        <div class="qb-score-sub">{{ $score->examination->subject->name ?? '—' }}</div>
                    </div>
                    <span class="qb-pill {{ $cls }}">{{ $pct }}%</span>
                    <i class="ti ti-chevron-right" style="color:var(--cream2);font-size:14px" aria-hidden="true"></i>
                </a>
            @empty
                <div class="qb-empty">
                    <i class="ti ti-chart-line" aria-hidden="true"></i>
                    No scores recorded yet.
                </div>
            @endforelse
        </div>

        {{-- Upcoming Exams --}}
        <div class="qb-panel">
            <div class="qb-panel-head">
                <div class="qb-panel-head-left">
                    <div class="qb-panel-icon">
                        <i class="ti ti-calendar-event" style="font-size:13px;color:var(--gold)" aria-hidden="true"></i>
                    </div>
                    <span class="qb-panel-title">Upcoming Exams</span>
                </div>
                <span class="qb-panel-badge">{{ $upcomingExams->count() }} scheduled</span>
            </div>

            @forelse ($upcomingExams as $exam)
                <div class="qb-exam-item">
                    <div class="qb-exam-dot"></div>
                    <div class="qb-exam-info">
                        <div class="qb-exam-name">{{ $exam->title }}</div>
                        <div class="qb-exam-subject">
                            <i class="ti ti-book-2" style="font-size:11px" aria-hidden="true"></i>
                            {{ $exam->subject->name }}
                        </div>
                    </div>
                    @if ($exam->scheduled_at)
                        <div class="qb-exam-date">
                            <div class="qb-exam-day">{{ $exam->scheduled_at->format('M d, Y') }}</div>
                            <div class="qb-exam-time">{{ $exam->scheduled_at->format('h:i A') }}</div>
                        </div>
                    @else
                        <span class="qb-exam-chip">TBA</span>
                    @endif
                </div>
            @empty
                <div class="qb-empty">
                    <i class="ti ti-calendar-off" aria-hidden="true"></i>
                    No upcoming exams scheduled.
                </div>
            @endforelse
        </div>

    </div>

</div>

@endsection
