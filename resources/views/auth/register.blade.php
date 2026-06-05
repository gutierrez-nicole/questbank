<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuestBank — Register | Holy Cross College</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:       #0c2340;
            --navy2:      #1a3a5c;
            --gold:       #e8b84b;
            --gold-dim:   #c9922a;
            --cream:      #f7f3ec;
            --cream2:     #e0d8c8;
            --ink:        #1a1a16;
            --muted:      #7a7060;
            --hint:       #b0a890;
            --border:     rgba(0,0,0,.12);
        }

        html, body { height: 100%; font-family: 'Sora', sans-serif; }

        /* ── Layout ── */
        .page {
            display: grid;
            grid-template-columns: 52% 48%;
            min-height: 100vh;
        }

        /* ══════════════ LEFT PANEL ══════════════ */
        .panel-left {
            background: var(--navy);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 44px;
            overflow: hidden;
        }

        .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.06);
            pointer-events: none;
        }
        .ring-1 { width: 520px; height: 520px; top: -150px; right: -170px; }
        .ring-2 { width: 300px; height: 300px; bottom: 60px;  left: -90px;  }
        .ring-3 { width: 180px; height: 180px; top: 42%; right: -50px; }

        .top-block {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            position: relative;
            z-index: 2;
        }

        .logo-tile {
            width: 74px;
            height: 74px;
            background: #fff;
            border: 3px solid rgba(232,184,75,.85);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0,0,0,.18);
        }

        .logo-img {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            object-fit: cover;
        }

        .school-name {
            font-size: .62rem;
            font-weight: 600;
            letter-spacing: 1.3px;
            text-transform: uppercase;
            color: rgba(255,255,255,.4);
            line-height: 1.6;
            margin-bottom: 3px;
        }

        .brand-line { display: flex; align-items: baseline; }

        .brand-quest {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.5px;
        }

        .brand-bank {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-style: italic;
            font-weight: 400;
            color: var(--gold);
            letter-spacing: -.3px;
        }

        .mid-block {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 32px 0;
            position: relative;
            z-index: 2;
        }

        .ai-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(232,184,75,.1);
            border: 1px solid rgba(232,184,75,.22);
            border-radius: 20px;
            padding: 4px 13px;
            margin-bottom: 18px;
            width: fit-content;
        }

        .ai-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
        }

        .ai-label {
            font-size: .62rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 600;
        }

        .main-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
            margin-bottom: 10px;
        }

        .main-title em {
            color: var(--gold);
            font-style: italic;
        }

        .main-desc {
            font-size: .76rem;
            color: rgba(255,255,255,.5);
            line-height: 1.75;
            margin-bottom: 26px;
            max-width: 320px;
        }

        .features { display: flex; flex-direction: column; gap: 10px; }

        .feat {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .73rem;
            color: rgba(255,255,255,.55);
        }

        .feat-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bottom-block {
            position: relative;
            z-index: 2;
        }

        /* ══════════════ RIGHT PANEL ══════════════ */
        .panel-right {
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 60px;
        }

        .form-wrap {
            width: 100%;
            max-width: 400px;
            animation: fadeUp .42s cubic-bezier(.22,.68,0,1.1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-eyebrow {
            font-size: .62rem;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--gold-dim);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.2;
            margin-bottom: 5px;
        }

        .form-sub {
            font-size: .76rem;
            color: var(--muted);
            margin-bottom: 24px;
            line-height: 1.65;
        }

        /* Alert */
        .alert-danger {
            background: #fef2f2;
            border-left: 3px solid #dc2626;
            border-radius: 6px;
            padding: 9px 13px;
            font-size: .78rem;
            color: #b91c1c;
            margin-bottom: 18px;
        }

        /* Two-column grid for fields */
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .field { margin-bottom: 0; }
        .field-full { grid-column: 1 / -1; }

        .field-label {
            display: block;
            font-size: .6rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--ink);
            margin-bottom: 5px;
        }

        .input-shell { position: relative; }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6f675c;
            width: 19px;
            height: 19px;
            pointer-events: none;
            flex-shrink: 0;
            z-index: 2;
        }

        .input-shell.has-divider::after {
            content: '';
            position: absolute;
            left: 47px;
            top: 14px;
            bottom: 14px;
            width: 1px;
            background: var(--cream2);
            z-index: 2;
        }

        .input-eye {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #6f675c;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
            display: flex;
            align-items: center;
            line-height: 1;
        }

        .form-control {
            width: 100%;
            min-height: 50px;
            padding: 12px 14px 12px 56px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: .82rem;
            color: var(--ink);
            background: #fff;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .form-control:focus {
            border-color: var(--gold-dim);
            box-shadow: 0 0 0 3px rgba(201,146,42,.14);
        }

        .form-control::placeholder { color: #687386; opacity: 1; }

        .password-control {
            padding-right: 44px;
        }

        /* Select styling */
        .form-select {
            width: 100%;
            min-height: 50px;
            padding: 12px 36px 12px 56px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: .82rem;
            color: var(--ink);
            background: #fff;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236f675c' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            transition: border-color .15s, box-shadow .15s;
        }

        .form-select:focus {
            border-color: var(--gold-dim);
            box-shadow: 0 0 0 3px rgba(201,146,42,.14);
        }

        /* Divider between sections */
        .section-divider {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .58rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--hint);
            margin: 4px 0;
        }

        .section-divider::before, .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--cream2);
        }

        /* Buttons row */
        .btn-row {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-register {
            flex: 1;
            padding: 12px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-family: 'Sora', sans-serif;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: background .15s, transform .1s;
        }

        .btn-register:hover  { background: var(--navy2); }
        .btn-register:active { transform: scale(.98); }

        .btn-back {
            padding: 12px 18px;
            background: transparent;
            color: var(--muted);
            border: 1.5px solid var(--cream2);
            border-radius: 7px;
            font-family: 'Sora', sans-serif;
            font-size: .78rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: border-color .15s, color .15s;
            white-space: nowrap;
        }

        .btn-back:hover {
            border-color: var(--gold-dim);
            color: var(--gold-dim);
        }

        /* Login link */
        .login-row {
            text-align: center;
            font-size: .75rem;
            color: var(--muted);
            margin-top: 16px;
        }

        .login-row a {
            color: var(--gold-dim);
            font-weight: 600;
            text-decoration: none;
        }

        .login-row a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 768px) {
            .page { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 24px; }
            .fields-grid { grid-template-columns: 1fr; }
            .field-full { grid-column: 1; }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- ══ LEFT PANEL ══ --}}
    <div class="panel-left">

        <div class="ring ring-1"></div>
        <div class="ring ring-2"></div>
        <div class="ring ring-3"></div>

        {{-- Logo + School --}}
        <div class="top-block">
            <div class="logo-tile">
                <img
                    src="{{ asset('images/questbank.jpg') }}"
                    alt="Holy Cross College logo"
                    class="logo-img"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                >
                <svg style="display:none" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <rect x="3" y="2" width="14" height="20" rx="2" fill="rgba(255,255,255,.18)" stroke="rgba(255,255,255,.5)" stroke-width="1.4"/>
                    <rect x="7" y="2" width="14" height="20" rx="2" fill="rgba(255,255,255,.08)" stroke="rgba(255,255,255,.28)" stroke-width="1.4"/>
                    <path d="M10.5 13.5l2.5 2.5 4.5-5" stroke="#e8b84b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="school-name">Holy Cross College · Santa Ana, Pampanga</div>
                <div class="brand-line">
                    <span class="brand-quest">Quest</span><span class="brand-bank">Bank</span>
                </div>
            </div>
        </div>

        {{-- Main content --}}
        <div class="mid-block">
            <div class="ai-badge">
                <div class="ai-dot"></div>
                <span class="ai-label">AI-Powered System</span>
            </div>

            <h1 class="main-title">
                Join the <em>Smart</em><br>
                Examination<br>
                Platform
            </h1>

            <p class="main-desc">
                Create your account to access automated grading,
                performance analytics, and AI-powered examination
                tools for Civil Engineering students.
            </p>

            <div class="features">
                <div class="feat">
                    <div class="feat-icon">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#e8b84b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="6.5" cy="4.5" r="2.5"/>
                            <path d="M1 12c0-3 2.5-5 5.5-5s5.5 2 5.5 5"/>
                        </svg>
                    </div>
                    Faculty &amp; student role-based access
                </div>
                <div class="feat">
                    <div class="feat-icon">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#e8b84b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2.5" y="6.5" width="8" height="5" rx="1"/>
                            <path d="M4.5 6.5V4.5a2 2 0 014 0v2"/>
                            <circle cx="6.5" cy="9" r=".8" fill="#e8b84b" stroke="none"/>
                        </svg>
                    </div>
                    Secure, verified institutional accounts
                </div>
                <div class="feat">
                    <div class="feat-icon">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#e8b84b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="1,10 4,6 6.5,8.5 9.5,4 12,5"/>
                            <line x1="12" y1="10" x2="1" y2="10"/>
                        </svg>
                    </div>
                    Instant access to performance analytics
                </div>
            </div>
        </div>

        <div class="bottom-block"></div>

    </div>

    {{-- ══ RIGHT PANEL ══ --}}
    <div class="panel-right">
        <div class="form-wrap">

            <div class="form-eyebrow">Student &amp; Faculty Portal</div>
            <h2 class="form-title">Create your<br>QuestBank account</h2>
            <p class="form-sub">Fill in your details to register and get started.</p>

            @if ($errors->any())
                <div class="alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="fields-grid">

                    {{-- Full Name --}}
                    <div class="field">
                        <label class="field-label" for="name">Full Name</label>
                        <div class="input-shell has-divider">
                            <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="7" cy="5" r="3"/>
                                <path d="M1 13c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                            </svg>
                            <input
                                id="name"
                                class="form-control"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="Juan dela Cruz"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="field">
                        <label class="field-label" for="email">Email Address</label>
                        <div class="input-shell has-divider">
                            <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="12" height="8" rx="1.5"/>
                                <path d="M1 4.5l6 4 6-4"/>
                            </svg>
                            <input
                                id="email"
                                class="form-control"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required
                            >
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="field">
                        <label class="field-label" for="username">Username</label>
                        <div class="input-shell has-divider">
                            <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 9.5c0-1.1.9-2 2-2h6c1.1 0 2 .9 2 2v1H2v-1z"/>
                                <circle cx="7" cy="5" r="2.5"/>
                                <path d="M9.5 2.5l2 2M9.5 4.5l2-2" stroke-linecap="round"/>
                            </svg>
                            <input
                                id="username"
                                class="form-control"
                                name="username"
                                type="text"
                                value="{{ old('username') }}"
                                placeholder="jdelacruz"
                                required
                            >
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="field">
                        <label class="field-label" for="role_id">Role</label>
                        <div class="input-shell has-divider">
                            <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="1" width="5" height="6" rx="1"/>
                                <rect x="8" y="1" width="5" height="3" rx="1"/>
                                <rect x="1" y="9" width="12" height="4" rx="1"/>
                                <rect x="8" y="6" width="5" height="3" rx="1"/>
                            </svg>
                            <select id="role_id" class="form-select" name="role_id" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="student-fields" class="role-fields" style="display: none; grid-column: 1 / -1;">
                        <div class="field student-role">
                            <label class="field-label" for="student_number">Student ID Number</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="student_number"
                                    class="form-control"
                                    name="student_number"
                                    type="text"
                                    value="{{ old('student_number') }}"
                                    placeholder="STU-00001"
                                >
                            </div>
                        </div>
                        <div class="field student-role">
                            <label class="field-label" for="year_level">Year Level</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="year_level"
                                    class="form-control"
                                    name="year_level"
                                    type="text"
                                    value="{{ old('year_level') }}"
                                    placeholder="3rd Year"
                                >
                            </div>
                        </div>
                        <div class="field student-role">
                            <label class="field-label" for="section">Section</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="section"
                                    class="form-control"
                                    name="section"
                                    type="text"
                                    value="{{ old('section') }}"
                                    placeholder="CE-3A"
                                >
                            </div>
                        </div>
                        <div class="field student-role">
                            <label class="field-label" for="program">Course</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="program"
                                    class="form-control"
                                    name="program"
                                    type="text"
                                    value="Bachelor of Science in Civil Engineering (BSCE)"
                                    readonly
                                >
                            </div>
                        </div>
                    </div>

                    <div id="instructor-fields" class="role-fields" style="display: none; grid-column: 1 / -1;">
                        <div class="field instructor-role">
                            <label class="field-label" for="employee_number">Employee ID Number</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="employee_number"
                                    class="form-control"
                                    name="employee_number"
                                    type="text"
                                    value="{{ old('employee_number') }}"
                                    placeholder="INS-00001"
                                >
                            </div>
                        </div>
                        <div class="field instructor-role">
                            <label class="field-label" for="department">Department</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="department"
                                    class="form-control"
                                    name="department"
                                    type="text"
                                    value="{{ old('department', 'Civil Engineering') }}"
                                    placeholder="Civil Engineering"
                                >
                            </div>
                        </div>
                        <div class="field instructor-role">
                            <label class="field-label" for="position">Position</label>
                            <div class="input-shell has-divider">
                                <input
                                    id="position"
                                    class="form-control"
                                    name="position"
                                    type="text"
                                    value="{{ old('position') }}"
                                    placeholder="Instructor / Lecturer"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Section divider --}}
                    <div class="section-divider">Set Password</div>

                    {{-- Password --}}
                    <div class="field">
                        <label class="field-label" for="password">Password</label>
                        <div class="input-shell">
                            <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2.5" y="6.5" width="9" height="6" rx="1.5"/>
                                <path d="M4.5 6.5V4.5a2.5 2.5 0 015 0v2"/>
                            </svg>
                            <input
                                id="password"
                                class="form-control password-control"
                                name="password"
                                type="password"
                                placeholder="Min. 8 characters"
                                required
                            >
                            <button type="button" class="input-eye" onclick="togglePwd('password','eye-1')" aria-label="Show/hide password">
                                <svg id="eye-1" width="15" height="15" viewBox="0 0 15 15" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/>
                                    <circle cx="7.5" cy="7.5" r="2"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="field">
                        <label class="field-label" for="password_confirmation">Confirm Password</label>
                        <div class="input-shell">
                            <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2.5" y="6.5" width="9" height="6" rx="1.5"/>
                                <path d="M4.5 6.5V4.5a2.5 2.5 0 015 0v2"/>
                                <path d="M5.5 9.5l1.5 1.5 2-2.5" stroke="#e8b84b"/>
                            </svg>
                            <input
                                id="password_confirmation"
                                class="form-control password-control"
                                name="password_confirmation"
                                type="password"
                                placeholder="Repeat password"
                                required
                            >
                            <button type="button" class="input-eye" onclick="togglePwd('password_confirmation','eye-2')" aria-label="Show/hide password">
                                <svg id="eye-2" width="15" height="15" viewBox="0 0 15 15" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/>
                                    <circle cx="7.5" cy="7.5" r="2"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-register">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="6.5" cy="5" r="3"/>
                            <path d="M1 12c0-3 2.5-5 5.5-5s5.5 2 5.5 5"/>
                            <path d="M9.5 1.5l2 2M11.5 1.5l-2 2"/>
                        </svg>
                        Create Account
                    </button>
                    <a href="{{ route('login') }}" class="btn-back">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 2L4 6l4 4"/>
                        </svg>
                        Back
                    </a>
                </div>

            </form>

            <div class="login-row">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>

        </div>
    </div>

</div>

<script>
function togglePwd(fieldId, iconId) {
    const f = document.getElementById(fieldId);
    const ico = document.getElementById(iconId);
    if (f.type === 'password') {
        f.type = 'text';
        ico.innerHTML = '<path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/><line x1="2" y1="2" x2="13" y2="13" stroke="currentColor" stroke-width="1.4"/>';
    } else {
        f.type = 'password';
        ico.innerHTML = '<path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/><circle cx="7.5" cy="7.5" r="2"/>';
    }
}

function toggleRoleFields() {
    const roleSelect = document.getElementById('role_id');
    const roleName = roleSelect.selectedOptions[0]?.text || '';
    const showStudent = roleName === 'Student';
    const showInstructor = roleName === 'Instructor';

    document.getElementById('student-fields').style.display = showStudent ? 'grid' : 'none';
    document.getElementById('instructor-fields').style.display = showInstructor ? 'grid' : 'none';

    document.querySelectorAll('.student-role input').forEach(input => input.disabled = !showStudent);
    document.querySelectorAll('.student-role select').forEach(select => select.disabled = !showStudent);
    document.querySelectorAll('.instructor-role input').forEach(input => input.disabled = !showInstructor);
    document.querySelectorAll('.instructor-role select').forEach(select => select.disabled = !showInstructor);
}

document.getElementById('role_id').addEventListener('change', toggleRoleFields);
toggleRoleFields();
</script>
</body>
</html>