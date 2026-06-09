<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — NFC Institute</title>

    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 56px;
            --sidebar-bg: #1a2236;
            --sidebar-hover: #2a3652;
            --sidebar-active: #3b5bdb;
            --sidebar-text: #c8d0e0;
            --sidebar-heading: #6c7a99;
        }

        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        body { background: #f0f2f5; }

        /* ── Sidebar ── */
        #sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform .25s ease;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none; /* Firefox */
        }

        #sidebar::-webkit-scrollbar { display: none; } /* Chrome/Safari */

        #sidebar .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
            flex-shrink: 0;
        }

        #sidebar .sidebar-brand img { height: 32px; margin-right: .6rem; }
        #sidebar .sidebar-brand span { color: #fff; font-weight: 700; font-size: .95rem; }

        .sidebar-section-title {
            color: var(--sidebar-heading);
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 1.1rem 1.25rem .35rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .55rem 1.25rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: .875rem;
            border-radius: 6px;
            margin: 1px .5rem;
            transition: background .15s, color .15s;
        }

        .sidebar-link i { width: 18px; text-align: center; font-size: .9rem; }
        .sidebar-link:hover { background: var(--sidebar-hover); color: #fff; }
        .sidebar-link.active { background: var(--sidebar-active); color: #fff; font-weight: 600; }

        /* collapse group — removed, no longer used */

        /* ── Topbar ── */
        #topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            z-index: 1030;
            gap: 1rem;
        }

        #topbar .page-title { font-weight: 600; font-size: .95rem; color: #1a2236; }

        #topbar .topbar-right { margin-left: auto; display: flex; align-items: center; gap: .75rem; }

        .user-badge {
            display: flex; align-items: center; gap: .5rem;
            background: #f0f2f5; border-radius: 50px;
            padding: .3rem .75rem .3rem .3rem;
            font-size: .85rem; color: #1a2236;
        }

        .user-badge .avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--sidebar-active);
            color: #fff; font-size: .75rem;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }

        /* ── Main content ── */
        #main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 1.5rem;
            min-height: calc(100vh - var(--topbar-height));
        }

        /* ── Responsive ── */
        @media (max-width: 991px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #topbar { left: 0; }
            #main-content { margin-left: 0; }
            #sidebar-overlay { display: block !important; }
        }

        #sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.4);
            z-index: 1039;
        }

        /* ── Alert ── */
        .alert { border-radius: 8px; }

        /* ── Cards ── */
        .card { border: none; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .card-header { background: #fff; border-bottom: 1px solid #f0f2f5; font-weight: 600; border-radius: 10px 10px 0 0 !important; }
    </style>

    @stack('styles')
</head>
<body>

{{-- Sidebar overlay (mobile) --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

{{-- ══════════ SIDEBAR ══════════ --}}
<nav id="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('logo.png') }}" alt="NFC">
        <span>NFC Admin</span>
    </div>

    <div class="mt-2 pb-4">

        {{-- Main --}}
        <p class="sidebar-section-title">Main</p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        {{-- Admissions --}}
        <p class="sidebar-section-title">Admissions</p>

        <a href="{{ route('inquires') }}"
           class="sidebar-link {{ request()->routeIs('inquires') || request()->routeIs('inquiryform') ? 'active' : '' }}">
            <i class="fa-solid fa-file-lines"></i> Inquiries
        </a>

        {{-- Academic --}}
        <p class="sidebar-section-title">Academic</p>

        <a href="{{ route('departments.index') }}"
           class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
            <i class="fa-solid fa-building-columns"></i> Departments
        </a>

        <a href="{{ route('faculty') }}"
           class="sidebar-link {{ request()->routeIs('faculty*') ? 'active' : '' }}">
            <i class="fa-solid fa-chalkboard-user"></i> Faculty
        </a>

        <a href="{{ route('admin.students') }}"
           class="sidebar-link {{ request()->routeIs('admin.students') ? 'active' : '' }}">
            <i class="fa-solid fa-user-graduate"></i> Students
        </a>

        {{-- Access --}}
        <p class="sidebar-section-title">Access</p>

        <a href="{{ route('access.users.index') }}"
           class="sidebar-link {{ request()->routeIs('access.users.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Users
        </a>

        <a href="{{ route('access.roles.index') }}"
           class="sidebar-link {{ request()->routeIs('access.roles.*') ? 'active' : '' }}">
            <i class="fa-solid fa-shield-halved"></i> Roles
        </a>

        {{-- Account --}}
        <p class="sidebar-section-title">Account</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>

    </div>
</nav>

{{-- ══════════ TOPBAR ══════════ --}}
<header id="topbar">
    <button class="btn btn-sm btn-light d-lg-none" onclick="openSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <span class="page-title">@yield('page-title', 'Dashboard')</span>

    <div class="topbar-right">
        <div class="user-badge">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            {{ auth()->user()->name ?? 'Admin' }}
        </div>
    </div>
</header>

{{-- ══════════ MAIN CONTENT ══════════ --}}
<main id="main-content">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/js/custom.js') }}"></script>

<script>
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); }
</script>

@stack('scripts')
</body>
</html>
