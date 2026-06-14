<div class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container-fluid">

            {{-- Brand --}}
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('logo.png') }}" alt="NFC" class="h-100 d-inline-block" style="width:36px;height:36px;object-fit:contain;">
                <span class="fw-semibold d-none d-sm-inline">NFC Admin</span>
            </a>

            {{-- Mobile toggler --}}
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Center nav links --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-semibold' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-gauge-high me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inquires') || request()->routeIs('inquiryform') ? 'active fw-semibold' : '' }}"
                           href="{{ route('inquires') }}">
                            <i class="fa-solid fa-file-lines me-1"></i> Inquiries
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Right: user badge + menu toggle --}}
            <div class="d-flex align-items-center gap-2">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-user"></i>
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-sm">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </button>
                </div>
                <a class="btn btn-light border"
                   data-bs-toggle="offcanvas" href="#dashboardMenu" role="button"
                   aria-controls="dashboardMenu" title="Menu">
                    <span class="navbar-toggler-icon"></span>
                </a>
            </div>

        </div>
    </nav>
</div>

{{-- ═══════════════════ Off-Canvas Menu ═══════════════════ --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="dashboardMenu" aria-labelledby="dashboardMenuLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="dashboardMenuLabel">
            <i class="fa-solid fa-bars me-2 text-primary"></i>Dashboard Menu
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">

        {{-- Dashboard --}}
        <div class="list-group list-group-flush">
            <a href="{{ route('admin.dashboard') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
            </a>
        </div>

        {{-- Accordion --}}
        <div class="accordion accordion-flush" id="menuAccordion">

            {{-- Inquiries --}}
            @php $inquiryOpen = request()->routeIs('inquires') || request()->routeIs('inquiryform'); @endphp
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $inquiryOpen ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#menuInquiries"
                            aria-expanded="{{ $inquiryOpen ? 'true' : 'false' }}"
                            aria-controls="menuInquiries">
                        <i class="fa-solid fa-file-lines me-2"></i> Inquiries
                    </button>
                </h2>
                <div id="menuInquiries"
                     class="accordion-collapse collapse {{ $inquiryOpen ? 'show' : '' }}"
                     data-bs-parent="#menuAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('inquiryform') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('inquiryform') ? 'active' : '' }}">
                                <i class="fa-solid fa-plus me-2"></i> Add Inquiry
                            </a>
                            <a href="{{ route('inquires') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('inquires') ? 'active' : '' }}">
                                <i class="fa-solid fa-list me-2"></i> All Inquiries
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Academic --}}
            @php $academicOpen = request()->routeIs('departments.*') || request()->routeIs('faculty*') || request()->routeIs('admin.students'); @endphp
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $academicOpen ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#menuAcademic"
                            aria-expanded="{{ $academicOpen ? 'true' : 'false' }}"
                            aria-controls="menuAcademic">
                        <i class="fa-solid fa-building-columns me-2"></i> Academic
                    </button>
                </h2>
                <div id="menuAcademic"
                     class="accordion-collapse collapse {{ $academicOpen ? 'show' : '' }}"
                     data-bs-parent="#menuAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('departments.index') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-building-columns me-2"></i> Departments
                            </a>
                            <a href="{{ route('faculty') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('faculty*') ? 'active' : '' }}">
                                <i class="fa-solid fa-chalkboard-user me-2"></i> Faculty
                            </a>
                            <a href="{{ route('admin.students') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('admin.students') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-graduate me-2"></i> Students
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Access Control --}}
            @php $accessOpen = request()->routeIs('access.users.*') || request()->routeIs('access.roles.*'); @endphp
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $accessOpen ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#menuAccess"
                            aria-expanded="{{ $accessOpen ? 'true' : 'false' }}"
                            aria-controls="menuAccess">
                        <i class="fa-solid fa-shield-halved me-2"></i> Access Control
                    </button>
                </h2>
                <div id="menuAccess"
                     class="accordion-collapse collapse {{ $accessOpen ? 'show' : '' }}"
                     data-bs-parent="#menuAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('access.users.index') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('access.users.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users me-2"></i> Users
                            </a>
                            <a href="{{ route('access.roles.index') }}"
                               class="list-group-item list-group-item-action ps-4 {{ request()->routeIs('access.roles.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-key me-2"></i> Roles
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /accordion --}}

        {{-- Logout --}}
        <div class="list-group list-group-flush mt-auto border-top">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action text-danger">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                </button>
            </form>
        </div>

    </div>
</div>
