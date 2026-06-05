@extends('layouts.app', ['title' => 'Account Management'])

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

    .qb-body { padding: 24px 28px; }

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
        padding: 18px 20px;
        position: relative;
        overflow: hidden;
        animation: qbFade .4s ease both;
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
    }

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
        color: #fff;
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
    }

    .qb-table thead th {
        background: var(--cream);
        color: var(--navy);
        border-bottom: 1px solid var(--cream2);
        font-weight: 700;
        padding: 14px 18px;
        text-align: left;
    }

    .qb-table tbody tr {
        border-bottom: 1px solid var(--cream3);
    }

    .qb-table tbody td {
        padding: 14px 18px;
        vertical-align: middle;
    }

    .qb-table .badge {
        font-size: .72rem;
        font-weight: 600;
        padding: 6px 10px;
    }

    @keyframes qbFade {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 900px) {
        .qb-nav { display: none; }
        .qb-stat-grid { grid-template-columns: 1fr; }
        .qb-panels { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="qb-topbar">
    <a href="{{ route('dashboard') }}" class="qb-brand">
        <div class="qb-brand-logo">
            <img src="{{ asset('images/logo.png') }}" alt="QuestBank" onerror="this.style.display='none';this.parentElement.innerHTML='Q'">
        </div>
        <div class="qb-brand-name">Quest<span>Bank</span></div>
    </a>
    <div class="qb-nav">
        <a href="{{ route('accounts.index') }}" class="qb-nav-item active"><i class="ti ti-users"></i> Accounts</a>
        <a href="{{ route('accounts.create') }}" class="qb-nav-item"><i class="ti ti-user-plus"></i> Register</a>
    </div>
    <div class="qb-topbar-right">
        <div class="qb-notif"><i class="ti ti-bell"></i><span class="qb-notif-dot"></span></div>
        <div class="qb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
    </div>
</div>

<div class="qb-body">
    <div class="qb-page-head">
        <div>
            <div class="qb-eyebrow">Account Management</div>
            <div class="qb-page-title">Registered Accounts</div>
            <div class="qb-page-sub">Review user access, modify roles, and manage activation status.</div>
        </div>
        <div class="qb-date-badge"><strong>{{ now()->format('M j') }}</strong> {{ now()->format('l, Y') }}</div>
    </div>

    @php
        $activeCount = $users->where('is_active', true)->count();
        $inactiveCount = $users->where('is_active', false)->count();
    @endphp

    <div class="qb-stat-grid">
        <div class="qb-stat">
            <div class="qb-stat-bar navy"></div>
            <div class="qb-stat-top">
                <div>
                    <div class="qb-stat-label">Total Accounts</div>
                    <div class="qb-stat-num">{{ $users->total() }}</div>
                </div>
                <div class="qb-stat-icon"><i class="ti ti-users"></i></div>
            </div>
            <div class="qb-stat-desc">Total accounts across all pages.</div>
        </div>
        <div class="qb-stat">
            <div class="qb-stat-bar gold"></div>
            <div class="qb-stat-top">
                <div>
                    <div class="qb-stat-label">Active Accounts</div>
                    <div class="qb-stat-num">{{ $activeCount }}</div>
                </div>
                <div class="qb-stat-icon"><i class="ti ti-check"></i></div>
            </div>
            <div class="qb-stat-desc">Active accounts shown on this page.</div>
        </div>
        <div class="qb-stat">
            <div class="qb-stat-bar navy"></div>
            <div class="qb-stat-top">
                <div>
                    <div class="qb-stat-label">Inactive Accounts</div>
                    <div class="qb-stat-num">{{ $inactiveCount }}</div>
                </div>
                <div class="qb-stat-icon"><i class="ti ti-ban"></i></div>
            </div>
            <div class="qb-stat-desc">Accounts currently inactive on this page.</div>
        </div>
    </div>

    <div class="qb-panels">
        <div class="qb-panel">
            <div class="qb-panel-head">
                <div class="qb-panel-head-left">
                    <div class="qb-panel-icon"><i class="ti ti-users"></i></div>
                    <div>
                        <div class="qb-panel-title">Account List</div>
                        <div class="qb-panel-badge">Manage user profiles</div>
                    </div>
                </div>
                <div class="qb-panel-badge">{{ $users->count() }} shown</div>
            </div>
            <div class="table-responsive">
                <table class="table qb-table mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role?->display_name }}</td>
                                <td><span class="badge text-bg-{{ $user->is_active ? 'success' : 'secondary' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('accounts.edit', $user) }}">Edit</a>
                                    <form method="POST" action="{{ route('accounts.toggle', $user) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-warning">{{ $user->is_active ? 'Deactivate' : 'Activate' }}</button>
                                    </form>
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
                        <div class="qb-panel-badge">Accounts shortcuts</div>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="list-group">
                    <a href="{{ route('accounts.create') }}" class="list-group-item list-group-item-action">Register New Account</a>
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Back to Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">Edit Your Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $users->links() }}</div>
</div>
@endsection
