<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuestBank — Login | Holy Cross College</title>
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

        /* decorative rings */
        .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.06);
            pointer-events: none;
        }
        .ring-1 { width: 520px; height: 520px; top: -150px; right: -170px; }
        .ring-2 { width: 300px; height: 300px; bottom: 60px;  left: -90px;  }
        .ring-3 { width: 180px; height: 180px; top: 42%; right: -50px; }

        /* Top: logo + school */
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

        /* Middle: title + features */
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

        /* Feature list */
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

        /* Bottom: course label */
        .bottom-block {
            position: relative;
            z-index: 2;
        }

        .dept-line {
            font-size: .62rem;
            letter-spacing: .8px;
            color: rgba(255,255,255,.22);
            text-transform: uppercase;
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
            max-width: 340px;
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
            margin-bottom: 28px;
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

        /* Field */
        .field { margin-bottom: 15px; }

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
            min-height: 54px;
            padding: 14px 16px 14px 62px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: .88rem;
            color: var(--ink);
            background: #fff;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            position: relative;
        }

        .form-control:focus {
            border-color: var(--gold-dim);
            box-shadow: 0 0 0 3px rgba(201,146,42,.14);
        }

        .form-control::placeholder { color: #687386; opacity: 1; }

        .password-control {
            padding-left: 52px;
            padding-right: 48px;
        }

        /* Remember + Forgot row */
        .field-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0 20px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .72rem;
            color: var(--muted);
            cursor: pointer;
        }

        .remember input[type="checkbox"] {
            width: 14px;
            height: 14px;
            accent-color: var(--navy);
            cursor: pointer;
        }

        .forgot {
            font-size: .72rem;
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }

        .forgot:hover { color: var(--gold-dim); }

        /* Sign-in button */
        .btn-signin {
            width: 100%;
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

        .btn-signin:hover  { background: var(--navy2); }
        .btn-signin:active { transform: scale(.98); }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 18px 0 15px;
            font-size: .62rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--hint);
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--cream2);
        }

        /* Register */
        .register-row {
            text-align: center;
            font-size: .75rem;
            color: var(--muted);
        }

        .register-row a {
            color: var(--gold-dim);
            font-weight: 600;
            text-decoration: none;
        }

        .register-row a:hover { text-decoration: underline; }

        /* Footer */
        .form-footer {
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px solid var(--cream2);
            text-align: center;
        }

        .form-footer span {
            display: block;
            font-size: .62rem;
            color: var(--hint);
            line-height: 1.7;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 24px; }
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
                {{-- Fallback SVG icon --}}
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
                Automated <em>Examination</em><br>
                Management &amp;<br>
                Performance Monitoring
            </h1>

            <p class="main-desc">
                Designed for Civil Engineering students — automates
                answer-sheet checking, grading, and academic analytics
                using AI &amp; OCR technology.
            </p>

            <div class="features">
                <div class="feat">
                    <div class="feat-icon">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#e8b84b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="1" width="5" height="6" rx="1"/>
                            <rect x="7" y="1" width="5" height="6" rx="1"/>
                            <rect x="1" y="8" width="11" height="4" rx="1"/>
                        </svg>
                    </div>
                    AI-powered answer sheet scanning &amp; grading
                </div>
                <div class="feat">
                    <div class="feat-icon">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#e8b84b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="1,10 4,6 6.5,8.5 9.5,4 12,5"/>
                            <line x1="12" y1="10" x2="1" y2="10"/>
                        </svg>
                    </div>
                    Real-time academic performance analytics
                </div>
                <div class="feat">
                    <div class="feat-icon">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#e8b84b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="6.5" cy="4.5" r="2.5"/>
                            <path d="M1 12c0-3 2.5-5 5.5-5s5.5 2 5.5 5"/>
                        </svg>
                    </div>
                    Instant feedback for students &amp; teachers
                </div>
            </div>
        </div>

        

    </div>

    {{-- ══ RIGHT PANEL ══ --}}
    <div class="panel-right">
        <div class="form-wrap">

            <div class="form-eyebrow">Student &amp; Faculty Portal</div>
            <h2 class="form-title">Sign in to<br>QuestBank</h2>
            <p class="form-sub">Enter your credentials to access the examination management system.</p>

            @if ($errors->any())
                <div class="alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email / Username --}}
                <div class="field">
                    <label class="field-label" for="login">Email Address</label>
                    <div class="input-shell has-divider">
                        <svg class="input-icon" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="12" height="8" rx="1.5"/>
                            <path d="M1 4.5l6 4 6-4"/>
                        </svg>
                        <input
                            id="login"
                            class="form-control"
                            name="login"
                            type="text"
                            value="{{ old('login') }}"
                            placeholder="you@example.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

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
                            placeholder="Your password"
                            required
                        >
                        <button type="button" class="input-eye" onclick="togglePwd()" aria-label="Show/hide password">
                            <svg id="eye-icon" width="15" height="15" viewBox="0 0 15 15" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/>
                                <circle cx="7.5" cy="7.5" r="2"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember / Forgot --}}
                <div class="field-row">
                    <label class="remember">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot">Forgot password?</a>
                </div>

                <button type="submit" class="btn-signin">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 2H3a1 1 0 00-1 1v7a1 1 0 001 1h2M9 9.5l3-3-3-3M12 6.5H5"/>
                    </svg>
                    Sign In
                </button>
            </form>

            <div class="divider">or</div>

            <div class="register-row">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </div>


        </div>
    </div>

</div>

<script>
function togglePwd() {
    const f = document.getElementById('password');
    const ico = document.getElementById('eye-icon');
    if (f.type === 'password') {
        f.type = 'text';
        ico.innerHTML = '<path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/><line x1="2" y1="2" x2="13" y2="13" stroke="currentColor" stroke-width="1.4"/>';
    } else {
        f.type = 'password';
        ico.innerHTML = '<path d="M1 7.5s2.5-5 6.5-5 6.5 5 6.5 5-2.5 5-6.5 5-6.5-5-6.5-5z"/><circle cx="7.5" cy="7.5" r="2"/>';
    }
}
</script>
</body>
</html>
