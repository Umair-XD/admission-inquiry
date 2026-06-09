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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <style>
            :root {
                --sw:        260px;
                --sw-col:    64px;
                --th:        56px;
                --sidebar:   #1a2236;
                --s-hover:   #2a3652;
                --s-active:  #3b5bdb;
                --s-text:    #c8d0e0;
                --s-heading: #6c7a99;
            }

            html, body { overflow-x: hidden; background: #f0f2f5; }

            /* ── SIDEBAR ── */
            #sidebar {
                position: fixed;
                top: 0; left: 0; bottom: 0;
                width: var(--sw);
                background: var(--sidebar);
                z-index: 1040;
                display: flex;
                flex-direction: column;
                overflow-y: auto;
                overflow-x: hidden;
                scrollbar-width: none;
                transition: width .25s ease;
            }
            #sidebar::-webkit-scrollbar { display: none; }

            /* Brand */
            .sb-brand {
                height: var(--th);
                display: flex;
                align-items: center;
                gap: .7rem;
                padding: 0 1.25rem;
                border-bottom: 1px solid rgba(255,255,255,.07);
                flex-shrink: 0;
                overflow: hidden;
            }
            .sb-brand img {
                width: 30px;
                height: 30px;
                object-fit: contain;
                flex-shrink: 0;
                filter: invert(1) brightness(2);
            }
            .sb-brand-name {
                color: #fff;
                font-weight: 700;
                font-size: .93rem;
                white-space: nowrap;
                transition: opacity .2s;
            }

            /* Section headings */
            .sb-heading {
                color: var(--s-heading);
                font-size: .68rem;
                font-weight: 600;
                letter-spacing: .07em;
                text-transform: uppercase;
                padding: 1rem 1.25rem .3rem;
                white-space: nowrap;
                transition: opacity .2s;
            }

            /* Nav links */
            .sb-link {
                display: flex;
                align-items: center;
                gap: .8rem;
                padding: .58rem 1.25rem;
                color: var(--s-text);
                text-decoration: none;
                font-size: .875rem;
                border-radius: 7px;
                margin: 2px .5rem;
                transition: background .15s, color .15s;
                white-space: nowrap;
                overflow: hidden;
            }
            .sb-link .ico {
                width: 22px;
                text-align: center;
                font-size: 1rem;
                flex-shrink: 0;
                line-height: 1;
            }
            .sb-link .lbl { transition: opacity .2s; }
            .sb-link:hover  { background: var(--s-hover);  color: #fff; }
            .sb-link.active { background: var(--s-active); color: #fff; font-weight: 600; }
            button.sb-link {
                width: calc(100% - 1rem);
                border: none;
                background: none;
                text-align: left;
                cursor: pointer;
            }

            /* ── COLLAPSED ── */
            #sidebar.collapsed { width: var(--sw-col); }

            #sidebar.collapsed .sb-brand-name,
            #sidebar.collapsed .sb-heading,
            #sidebar.collapsed .sb-link .lbl {
                opacity: 0;
                pointer-events: none;
                width: 0;
            }
            #sidebar.collapsed .sb-brand  { justify-content: center; padding: 0; gap: 0; }
            #sidebar.collapsed .sb-link   { justify-content: center; padding: .58rem 0; margin: 2px .25rem; }
            #sidebar.collapsed button.sb-link { width: calc(100% - .5rem); }

            /* Topbar / main shift */
            #sidebar.collapsed ~ #topbar       { left: var(--sw-col); }
            #sidebar.collapsed ~ #main-content { margin-left: var(--sw-col); }

            /* ── TOPBAR ── */
            #topbar {
                position: fixed;
                top: 0; right: 0; left: var(--sw);
                height: var(--th);
                background: #fff;
                border-bottom: 1px solid #e2e8f0;
                display: flex;
                align-items: center;
                padding: 0 1.5rem;
                z-index: 1030;
                gap: .75rem;
                transition: left .25s ease;
            }

            /* Pin toggle button — lives in topbar, left edge */
            #pin-btn {
                width: 32px; height: 32px;
                border-radius: 50%;
                border: 1.5px solid #e2e8f0;
                background: #f8f9fa;
                color: #6c757d;
                cursor: pointer;
                display: flex; align-items: center; justify-content: center;
                font-size: .75rem;
                flex-shrink: 0;
                transition: background .15s, color .15s, border-color .15s, transform .3s;
            }
            #pin-btn:hover { background: var(--s-active); color: #fff; border-color: var(--s-active); }
            #pin-btn.unpinned { transform: rotate(45deg); }

            .page-title { font-weight: 600; font-size: .95rem; color: #1a2236; }
            .topbar-right { margin-left: auto; display: flex; align-items: center; gap: .75rem; }
            .user-badge {
                display: flex; align-items: center; gap: .5rem;
                background: #f0f2f5; border-radius: 50px;
                padding: .3rem .75rem .3rem .3rem;
                font-size: .85rem; color: #1a2236;
            }
            .user-badge .avatar {
                width: 30px; height: 30px; border-radius: 50%;
                background: var(--s-active); color: #fff;
                font-size: .75rem; font-weight: 700;
                display: flex; align-items: center; justify-content: center;
            }

            /* ── MAIN CONTENT ── */
            #main-content {
                margin-left: var(--sw);
                margin-top: var(--th);
                padding: 1.5rem;
                min-height: calc(100vh - var(--th));
                transition: margin-left .25s ease;
            }

            /* ── MOBILE ── */
            #sb-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 1039;
            }
            @media (max-width: 991px) {
                #sidebar       { transform: translateX(-100%); transition: transform .25s ease; }
                #sidebar.open  { transform: translateX(0); }
                #topbar        { left: 0 !important; transition: none; }
                #main-content  { margin-left: 0 !important; transition: none; }
                #sb-overlay    { display: block; }
                #pin-btn       { display: none; }
            }

            /* ── CARDS ── */
            .card { border: none; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
            .card-header { background: #fff; border-bottom: 1px solid #f0f2f5; font-weight: 600; border-radius: 10px 10px 0 0 !important; }

            /* ── SWEETALERT TOASTS ── */
            .colored-toast.swal2-icon-success { background-color: #28c76f !important; }
            .colored-toast.swal2-icon-error   { background-color: #d34c4d !important; }
            .colored-toast.swal2-icon-warning { background-color: #e68f3c !important; }
            .colored-toast.swal2-icon-info    { background-color: #00bad1 !important; }
            .colored-toast .swal2-title       { color: #fff !important; }
            .colored-toast .swal2-close       { color: #fff !important; }
            .colored-toast .swal2-html-container { color: #fff !important; }
        </style>

        @stack('styles')
    </head>
    <body>

    <div id="sb-overlay" onclick="closeSidebar()"></div>

    {{-- ══ SIDEBAR ══ --}}
    <nav id="sidebar">
        <div class="sb-brand">
            <img src="{{ asset('logo.png') }}" alt="NFC">
            <span class="sb-brand-name">NFC Admin</span>
        </div>

        <div class="mt-1 pb-4">

            <p class="sb-heading">Main</p>
            <a href="{{ route('admin.dashboard') }}"
            class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            title="Dashboard">
                <span class="ico"><i class="fa-solid fa-gauge-high"></i></span>
                <span class="lbl">Dashboard</span>
            </a>

            <p class="sb-heading">Admissions</p>
            <a href="{{ route('inquires') }}"
            class="sb-link {{ request()->routeIs('inquires') || request()->routeIs('inquiryform') ? 'active' : '' }}"
            title="Inquiries">
                <span class="ico"><i class="fa-solid fa-file-lines"></i></span>
                <span class="lbl">Inquiries</span>
            </a>

            <p class="sb-heading">Academic</p>
            <a href="{{ route('departments.index') }}"
            class="sb-link {{ request()->routeIs('departments.*') ? 'active' : '' }}"
            title="Departments">
                <span class="ico"><i class="fa-solid fa-building-columns"></i></span>
                <span class="lbl">Departments</span>
            </a>
            <a href="{{ route('faculty') }}"
            class="sb-link {{ request()->routeIs('faculty*') ? 'active' : '' }}"
            title="Faculty">
                <span class="ico"><i class="fa-solid fa-chalkboard-user"></i></span>
                <span class="lbl">Faculty</span>
            </a>
            <a href="{{ route('admin.students') }}"
            class="sb-link {{ request()->routeIs('admin.students') ? 'active' : '' }}"
            title="Students">
                <span class="ico"><i class="fa-solid fa-user-graduate"></i></span>
                <span class="lbl">Students</span>
            </a>

            <p class="sb-heading">Access</p>
            <a href="{{ route('access.users.index') }}"
            class="sb-link {{ request()->routeIs('access.users.*') ? 'active' : '' }}"
            title="Users">
                <span class="ico"><i class="fa-solid fa-users"></i></span>
                <span class="lbl">Users</span>
            </a>
            <a href="{{ route('access.roles.index') }}"
            class="sb-link {{ request()->routeIs('access.roles.*') ? 'active' : '' }}"
            title="Roles">
                <span class="ico"><i class="fa-solid fa-shield-halved"></i></span>
                <span class="lbl">Roles</span>
            </a>

            <p class="sb-heading">Account</p>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sb-link" title="Logout">
                    <span class="ico"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="lbl">Logout</span>
                </button>
            </form>

        </div>
    </nav>

    {{-- ══ TOPBAR ══ --}}
    <header id="topbar">
        {{-- Mobile hamburger --}}
        <button class="btn btn-sm btn-light d-lg-none" onclick="openSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>

        {{-- Pin / Unpin sidebar --}}
        <button id="pin-btn" title="Pin / Unpin sidebar">
            <i class="fa-solid fa-thumbtack"></i>
        </button>

        <span class="page-title">@yield('page-title', 'Dashboard')</span>

        <div class="topbar-right">
            <div class="user-badge">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </div>
    </header>

    {{-- ══ CONTENT ══ --}}
    <main id="main-content">
        @yield('content')
    </main>

    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>

    <script>
    // ── SweetAlert toast helper ──
    function showAlert(message, icon) {
        Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: { popup: 'colored-toast' },
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: function (toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        }).fire({ icon: icon, title: message });
    }

    // ── Delete confirmation (replaces browser confirm()) ──
    function confirmDelete(formEl, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message || 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d34c4d',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Delete',
            cancelButtonText: 'Cancel',
            focusCancel: true,
            reverseButtons: true
        }).then(function (result) {
            if (result.isConfirmed) { formEl.submit(); }
        });
    }

    // ── Flash session toasts ──
    @if(session('success'))
    document.addEventListener('DOMContentLoaded', function () {
        showAlert('{{ addslashes(session('success')) }}', 'success');
    });
    @endif
    @if(session('error'))
    document.addEventListener('DOMContentLoaded', function () {
        showAlert('{{ addslashes(session('error')) }}', 'error');
    });
    @endif

    // ── Mobile sidebar ──
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); }

    // ── Pin / Unpin ──
    (function () {
        var sidebar = document.getElementById('sidebar');
        var pinBtn  = document.getElementById('pin-btn');
        var KEY     = 'nfc_sidebar_pinned';

        function apply(pinned) {
            if (pinned) {
                sidebar.classList.remove('collapsed');
                pinBtn.classList.remove('unpinned');
            } else {
                sidebar.classList.add('collapsed');
                pinBtn.classList.add('unpinned');
            }
            // Tooltips for icon-only collapsed state
            sidebar.querySelectorAll('.sb-link').forEach(function (el) {
                var tt = bootstrap.Tooltip.getInstance(el);
                if (tt) tt.dispose();
                if (!pinned) new bootstrap.Tooltip(el, { placement: 'right', trigger: 'hover' });
            });
        }

        var saved = localStorage.getItem(KEY);
        apply(saved === null ? true : saved === 'true');

        pinBtn.addEventListener('click', function () {
            var pinned = !sidebar.classList.contains('collapsed');
            localStorage.setItem(KEY, String(!pinned));
            apply(!pinned);
        });
    })();
    </script>

    @stack('scripts')
    </body>
</html>
