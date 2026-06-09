<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — NFC Institute</title>

    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg:     #1a2236;
            --sidebar-active: #3b5bdb;
            --sidebar-text:   #c8d0e0;
            --sidebar-heading:#6c7a99;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f0f2f5;
        }

        .login-wrap {
            min-height: 100vh;
            display: flex;
        }

        /* ── Left panel ── */
        .login-left {
            width: 420px;
            flex-shrink: 0;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            color: var(--sidebar-text);
        }

        .login-left .brand-logo {
            width: 72px;
            height: 72px;
            border-radius: 16px;
            background: rgba(59,91,219,.18);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
        }

        .login-left .brand-logo img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .login-left h1 {
            color: #fff;
            font-size: 1.35rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: .35rem;
        }

        .login-left p {
            color: var(--sidebar-heading);
            font-size: .85rem;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
            font-size: .875rem;
            color: var(--sidebar-text);
        }

        .feature-item .icon-wrap {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(59,91,219,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-active);
            flex-shrink: 0;
            font-size: .9rem;
        }

        /* ── Right panel ── */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            background: #f0f2f5;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--sidebar-bg);
            margin-bottom: .35rem;
        }

        .login-card .subtitle {
            color: #6c757d;
            font-size: .875rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            font-size: .85rem;
            color: #495057;
            margin-bottom: .4rem;
        }

        .form-control {
            border-radius: 8px;
            padding: .6rem .85rem;
            font-size: .9rem;
            border: 1.5px solid #dee2e6;
            transition: border-color .15s, box-shadow .15s;
        }

        .form-control:focus {
            border-color: var(--sidebar-active);
            box-shadow: 0 0 0 3px rgba(59,91,219,.12);
            outline: none;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .form-control {
            padding-left: 2.5rem;
        }

        .input-icon-wrap .input-icon {
            position: absolute;
            left: .85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: .85rem;
        }

        .btn-login {
            background: var(--sidebar-active);
            border: none;
            color: #fff;
            border-radius: 8px;
            padding: .65rem;
            font-weight: 600;
            font-size: .95rem;
            width: 100%;
            transition: background .15s, transform .1s;
        }

        .btn-login:hover {
            background: #2f4ac5;
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-error {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #dc2626;
            border-radius: 8px;
            padding: .65rem .9rem;
            font-size: .875rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-right { background: var(--sidebar-bg); }
            .login-card { max-width: 100%; }
        }
    </style>
</head>

<body>
<div class="login-wrap">

    {{-- ── LEFT ── --}}
    <div class="login-left">
        <div class="brand-logo">
            <img src="{{ asset('logo.png') }}" alt="NFC">
        </div>
        <h1>NFC Admin Panel</h1>
        <p>NFC Institute of Engineering<br>& Fertilizer Research</p>

        <div class="w-100" style="max-width:260px;">
            <div class="feature-item">
                <div class="icon-wrap"><i class="fa-solid fa-file-lines"></i></div>
                <span>Manage Admission Inquiries</span>
            </div>
            <div class="feature-item">
                <div class="icon-wrap"><i class="fa-solid fa-building-columns"></i></div>
                <span>Departments & Courses</span>
            </div>
            <div class="feature-item">
                <div class="icon-wrap"><i class="fa-solid fa-chalkboard-user"></i></div>
                <span>Faculty Management</span>
            </div>
            <div class="feature-item">
                <div class="icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                <span>Roles & Permissions</span>
            </div>
        </div>
    </div>

    {{-- ── RIGHT ── --}}
    <div class="login-right">
        <div class="login-card">

            <h2>Welcome back</h2>
            <p class="subtitle">Sign in to your admin account</p>

            {{-- Errors --}}
            @if(session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-icon-wrap">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               placeholder="mail@example.com"
                               autofocus
                               required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-icon-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
                </button>

            </form>

        </div>
    </div>

</div>
</body>
</html>
