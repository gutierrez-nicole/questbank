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
    </style>
</head>
<body>
@auth
<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-2 sidebar p-3">
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
            </nav>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
