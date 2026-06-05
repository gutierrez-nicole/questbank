<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'QuestBank' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7fb; color: #1e293b; }
        .sidebar { min-height: 100vh; background: #0f3d3e; }
        .sidebar a { color: #dbeafe; text-decoration: none; display: block; padding: .7rem 1rem; border-radius: .5rem; }
        .sidebar a:hover, .sidebar .active { background: rgba(255,255,255,.12); color: #fff; }
        .brand { color: #fff; font-weight: 700; letter-spacing: .02em; }
        .stat-card { border: 0; border-left: 5px solid #0f766e; box-shadow: 0 8px 20px rgba(15, 61, 62, .08); }
        .content-wrap { min-height: 100vh; }
        .table thead th { background: #e7f5f2; color: #134e4a; }
        .student-shell .sidebar,
        .instructor-shell .sidebar,
        .admin-shell .sidebar {
            background: #0c2340;
            padding: 20px 14px !important;
            position: relative;
            overflow: hidden;
        }
        .student-shell .sidebar::before,
        .student-shell .sidebar::after,
        .instructor-shell .sidebar::before,
        .instructor-shell .sidebar::after,
        .admin-shell .sidebar::before,
        .admin-shell .sidebar::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.06);
            pointer-events: none;
        }
        .student-shell .sidebar::before,
        .instructor-shell .sidebar::before,
        .admin-shell .sidebar::before { width: 190px; height: 190px; top: -70px; right: -75px; }
        .student-shell .sidebar::after,
        .instructor-shell .sidebar::after,
        .admin-shell .sidebar::after { width: 140px; height: 140px; bottom: 42px; left: -70px; }
        .student-sidebar-head,
        .student-sidebar-profile,
        .student-sidebar-nav {
            position: relative;
            z-index: 1;
        }
        .student-sidebar-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }
        .student-sidebar-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid rgba(232,184,75,.85);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }
        .student-sidebar-logo img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
        .student-brand {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1;
        }
        .student-brand span {
            color: #e8b84b;
            font-style: italic;
            font-weight: 400;
        }
        .student-brand-sub {
            color: rgba(255,255,255,.42);
            font-size: .58rem;
            letter-spacing: .9px;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .student-sidebar-profile {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 14px;
            padding: 12px;
            margin-bottom: 18px;
        }
        .student-profile-label {
            color: #e8b84b;
            font-size: .58rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .student-profile-name {
            color: #fff;
            font-size: .78rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .student-profile-sub {
            color: rgba(255,255,255,.45);
            font-size: .65rem;
            margin-top: 2px;
        }
        .student-sidebar-nav {
            display: grid;
            gap: 7px;
        }
        .student-shell .sidebar .student-nav-link,
        .instructor-shell .sidebar .student-nav-link,
        .admin-shell .sidebar .student-nav-link {
            color: rgba(255,255,255,.62);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 11px;
            border-radius: 10px;
            font-size: .76rem;
            font-weight: 500;
            letter-spacing: .1px;
            border: 1px solid transparent;
            transition: background .15s, color .15s, border-color .15s;
        }
        .student-shell .sidebar .student-nav-link i,
        .instructor-shell .sidebar .student-nav-link i,
        .admin-shell .sidebar .student-nav-link i {
            color: #e8b84b;
            font-size: 16px;
            width: 18px;
            text-align: center;
        }
        .student-shell .sidebar .student-nav-link:hover,
        .student-shell .sidebar .student-nav-link.active,
        .instructor-shell .sidebar .student-nav-link:hover,
        .instructor-shell .sidebar .student-nav-link.active,
        .admin-shell .sidebar .student-nav-link:hover,
        .admin-shell .sidebar .student-nav-link.active {
            background: rgba(255,255,255,.1);
            color: #fff;
            border-color: rgba(255,255,255,.1);
        }
        .student-shell .sidebar .student-nav-link.logout-link,
        .instructor-shell .sidebar .student-nav-link.logout-link,
        .admin-shell .sidebar .student-nav-link.logout-link {
            color: #ffb3b3;
        }
        .student-shell .sidebar .student-nav-link.logout-link:hover,
        .instructor-shell .sidebar .student-nav-link.logout-link:hover,
        .admin-shell .sidebar .student-nav-link.logout-link:hover {
            background: rgba(255,0,0,.15);
            color: #fff;
            border-color: rgba(255,0,0,.2);
        }
        .student-shell .navbar,
        .instructor-shell .navbar,
        .admin-shell .navbar {
            display: none;
        }
        .student-shell section.p-4,
        .instructor-shell section.p-4,
        .admin-shell section.p-4 {
            padding: 0 !important;
        }
        .student-shell,
        .instructor-shell,
        .admin-shell {
            background: #f7f3ec;
        }
        .student-page {
            min-height: 100vh;
            padding: 24px 28px;
            background: #f7f3ec;
            font-family: 'Sora', sans-serif;
            color: #1a1a16;
        }
        .student-page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .student-eyebrow {
            color: #c9922a;
            font-size: .58rem;
            font-weight: 600;
            letter-spacing: 1.35px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .student-page-title {
            color: #0c2340;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.45rem;
            line-height: 1.2;
            margin: 0;
        }
        .student-page-title em {
            color: #c9922a;
            font-style: italic;
        }
        .student-page-sub {
            color: #7a7060;
            font-size: .72rem;
            margin: 4px 0 0;
        }
        .student-chip {
            background: #fff;
            border: 1px solid #e0d8c8;
            border-radius: 9px;
            color: #7a7060;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: .7rem;
            padding: 8px 13px;
        }
        .student-card {
            background: #fff;
            border: 1px solid rgba(0,0,0,.07);
            border-radius: 14px;
            box-shadow: none;
            overflow: hidden;
        }
        .student-card-head {
            border-bottom: 1px solid #f0ebe1;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .student-card-title {
            color: #1a1a16;
            font-size: .78rem;
            font-weight: 600;
            margin: 0;
        }
        .student-table {
            margin: 0;
            font-size: .76rem;
        }
        .student-table thead th {
            background: #faf8f4;
            color: #7a7060;
            border-bottom: 1px solid #f0ebe1;
            font-size: .58rem;
            letter-spacing: .9px;
            text-transform: uppercase;
            padding: 12px 16px;
        }
        .student-table tbody td {
            border-color: #f0ebe1;
            padding: 13px 16px;
            vertical-align: middle;
        }
        .student-pill {
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            font-size: .65rem;
            font-weight: 600;
            padding: 4px 10px;
        }
        .student-pill.gold { background: #fdf3db; color: #92521a; }
        .student-pill.navy { background: #eef3f8; color: #0c2340; }
        .student-pill.green { background: #e8f5ee; color: #1a6b45; }
        .student-action {
            background: #0c2340;
            border: 0;
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .7rem;
            font-weight: 600;
            padding: 7px 12px;
            text-decoration: none;
        }
        .student-action:hover { background: #1a3a5c; color: #fff; }
        .student-secondary {
            border: 1px solid #e0d8c8;
            border-radius: 8px;
            color: #7a7060;
            display: inline-flex;
            font-size: .7rem;
            font-weight: 600;
            padding: 7px 12px;
            text-decoration: none;
        }
        .student-secondary:hover { background: #faf8f4; color: #0c2340; }
        .student-form-card {
            background: #fff;
            border: 1px solid rgba(0,0,0,.07);
            border-radius: 14px;
            overflow: hidden;
        }
        .student-form-card .card-header,
        .student-form-card .card-footer {
            background: #fff !important;
            border-color: #f0ebe1;
        }
        .student-form-card .form-label {
            color: #7a7060;
            font-size: .6rem;
            font-weight: 600;
            letter-spacing: .85px;
            text-transform: uppercase;
        }
        .student-form-card .form-control,
        .student-form-card .form-select {
            border-color: #e0d8c8;
            border-radius: 10px;
            font-size: .82rem;
            min-height: 44px;
        }
        .student-form-card .form-control:focus,
        .student-form-card .form-select:focus {
            border-color: #c9922a;
            box-shadow: 0 0 0 3px rgba(201,146,42,.12);
        }
        .student-form-card .btn-success {
            background: #0c2340;
            border-color: #0c2340;
            border-radius: 8px;
            font-size: .76rem;
            font-weight: 600;
            padding: 9px 14px;
        }
        .student-form-card .btn-success:hover {
            background: #1a3a5c;
            border-color: #1a3a5c;
        }
        .student-form-card .btn-outline-secondary {
            border-color: #e0d8c8;
            border-radius: 8px;
            color: #7a7060;
            font-size: .76rem;
            font-weight: 600;
            padding: 9px 14px;
        }
        .student-detail-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }
        .student-detail {
            background: #faf8f4;
            border: 1px solid #f0ebe1;
            border-radius: 12px;
            padding: 13px;
        }
        .student-detail-label {
            color: #b0a890;
            font-size: .58rem;
            font-weight: 600;
            letter-spacing: .85px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .student-detail-value {
            color: #0c2340;
            font-size: .82rem;
            font-weight: 600;
        }
        @media (max-width: 900px) {
            .student-detail-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 640px) {
            .student-page { padding: 18px 16px; }
            .student-detail-grid { grid-template-columns: 1fr; }
        }
    </style>
    @yield('styles')
</head>
<body>
@auth
<div class="container-fluid {{ auth()->user()->isRole('student') ? 'student-shell' : (auth()->user()->isRole('instructor') ? 'instructor-shell' : (auth()->user()->isRole('admin') ? 'admin-shell' : '')) }}">
    <div class="row">
        <aside class="col-lg-2 sidebar p-3">
            @if(auth()->user()->isRole('student'))
                <div class="student-sidebar-head">
                    <div class="student-sidebar-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="QuestBank"
                             onerror="this.style.display='none';this.parentElement.innerHTML='Q'">
                    </div>
                    <div>
                        <div class="student-brand">Quest<span>Bank</span></div>
                        <div class="student-brand-sub">HCC CE Portal</div>
                    </div>
                </div>
                <div class="student-sidebar-profile">
                    <div class="student-profile-label">Student Portal</div>
                    <div class="student-profile-name">{{ auth()->user()->name }}</div>
                    <div class="student-profile-sub">Civil Engineering</div>
                </div>
                <nav class="student-sidebar-nav">
                    <a href="{{ route('dashboard') }}" class="student-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ti ti-layout-dashboard" aria-hidden="true"></i> Dashboard
                    </a>
                    <a href="{{ route('examinations.index') }}" class="student-nav-link {{ request()->routeIs('examinations.*') ? 'active' : '' }}">
                        <i class="ti ti-file-text" aria-hidden="true"></i> Take Examinations
                    </a>
                    <a href="{{ route('results.index') }}" class="student-nav-link {{ request()->routeIs('results.*') ? 'active' : '' }}">
                        <i class="ti ti-chart-bar" aria-hidden="true"></i> View Results
                    </a>
                    <a href="{{ route('profile.edit') }}" class="student-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="ti ti-user-edit" aria-hidden="true"></i> Edit Own Profile
                    </a>
                    <a href="{{ route('accounts.create') }}" class="student-nav-link {{ request()->routeIs('accounts.create') ? 'active' : '' }}">
                        <i class="ti ti-user-plus" aria-hidden="true"></i> Register New Accounts
                    </a>
                    <a href="#" class="student-nav-link logout-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="ti ti-power" aria-hidden="true"></i> Logout
                    </a>
                </nav>
            @elseif(auth()->user()->isRole('instructor') || auth()->user()->isRole('admin'))
                <div class="student-sidebar-head">
                    <div class="student-sidebar-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="QuestBank"
                             onerror="this.style.display='none';this.parentElement.innerHTML='Q'">
                    </div>
                    <div>
                        <div class="student-brand">Quest<span>Bank</span></div>
                        <div class="student-brand-sub">{{ auth()->user()->isRole('admin') ? 'Admin Portal' : 'Instructor Portal' }}</div>
                    </div>
                </div>
                <div class="student-sidebar-profile">
                    <div class="student-profile-label">{{ auth()->user()->isRole('admin') ? 'Admin Access' : 'Instructor Access' }}</div>
                    <div class="student-profile-name">{{ auth()->user()->name }}</div>
                    <div class="student-profile-sub">{{ auth()->user()->role?->display_name ?? (auth()->user()->isRole('admin') ? 'Admin' : 'Instructor') }}</div>
                </div>
                <nav class="student-sidebar-nav">
                    <a href="{{ route('dashboard') }}" class="student-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ti ti-layout-dashboard" aria-hidden="true"></i> Dashboard
                    </a>
                    <a href="{{ route('accounts.index') }}" class="student-nav-link {{ request()->routeIs('accounts.*') ? 'active' : '' }}">
                        <i class="ti ti-users" aria-hidden="true"></i> Account Management
                    </a>
                    <a href="{{ route('examinations.index') }}" class="student-nav-link {{ request()->routeIs('examinations.*') ? 'active' : '' }}">
                        <i class="ti ti-file-text" aria-hidden="true"></i> Examinations
                    </a>
                    <a href="{{ route('questions.index') }}" class="student-nav-link {{ request()->routeIs('questions.*') ? 'active' : '' }}">
                        <i class="ti ti-book" aria-hidden="true"></i> Question Bank
                    </a>
                    <a href="{{ route('results.index') }}" class="student-nav-link {{ request()->routeIs('results.*') ? 'active' : '' }}">
                        <i class="ti ti-chart-bar" aria-hidden="true"></i> Student Results
                    </a>
                    <a href="{{ route('reports.performance') }}" class="student-nav-link {{ request()->routeIs('reports.performance') ? 'active' : '' }}">
                        <i class="ti ti-report" aria-hidden="true"></i> Performance Reports
                    </a>
                    <a href="{{ route('profile.edit') }}" class="student-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="ti ti-user-edit" aria-hidden="true"></i> Profile
                    </a>
                    <a href="#" class="student-nav-link logout-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="ti ti-power" aria-hidden="true"></i> Logout
                    </a>
                </nav>
            @else
                <div class="brand mb-1">QuestBank</div>
                <div class="text-white-50 small mb-4">Holy Cross College CE</div>
                <nav class="d-grid gap-1">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('accounts.index') }}">Account Management</a>
                    <a href="{{ route('students.index') }}">Students</a>
                    <a href="{{ route('instructors.index') }}">Instructors</a>
                    <a href="{{ route('subjects.index') }}">Subjects</a>
                    <a href="{{ route('examinations.index') }}">Examinations</a>
                    <a href="{{ route('questions.index') }}">Question Bank</a>
                    <a href="{{ route('results.index') }}">Results</a>
                    <a href="{{ route('reports.performance') }}">Performance Reports</a>
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                </nav>
            @endif
        </aside>
        <main class="col-lg-10 content-wrap p-0">
            <nav class="navbar bg-white border-bottom px-4">
                <div>
                    <div class="fw-semibold">{{ $title ?? 'QuestBank' }}</div>
                    <small class="text-muted">Civil Engineering Program, Holy Cross College</small>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge text-bg-success">{{ auth()->user()->role?->display_name }}</span>
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm">Logout</button>
                    </form>
                </div>
            </nav>
            <section class="p-4">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please review the form.</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </section>
        </main>
    </div>
</div>
@else
    @yield('content')
@endauth

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout? Any unsaved changes will be lost.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
