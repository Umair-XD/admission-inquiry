
<!-- =============== MAIN HEADER (NOW SAME SIZE AS FOOTER) =============== -->
@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif
<div class="header-bg">
    <div class="d-flex justify-content-center align-items-center gap-3 py-2">
        <img src="{{ asset('faculty_pictures/nfc.png') }}" height="70">

        <div class="fw-bold text-dark fs-3 m-0">
            NFC Institute of Engineering and Fertilizer Research
        </div>
    </div>
</div>

<!-- ================= ABOUT MENU ================= -->
<nav class="sub-header-bg py-2 text-center" style="z-index: 500;">

    <a href="{{ route('about') }}" class="text-white text-decoration-none mx-3 small sub-header fw-semibold text-uppercase">About</a>
    <a href="{{ route('institute') }}" class="text-white text-decoration-none mx-3 small sub-header fw-semibold text-uppercase">Institute</a>
    <a href="{{ route('admission') }}" class="text-white text-decoration-none mx-3 small sub-header fw-semibold text-uppercase">Admissions</a>
    <a href="{{ route('academics') }}" class="text-white text-decoration-none mx-3 small fw-semibold text-uppercase sub-header">Academics</a>
    <a href="{{ route('researchinnovation') }}" class="text-white text-decoration-none mx-3 small fw-semibold text-uppercase sub-header">Research & Innovation</a>
    <a href="{{ route('campuslife') }}" class="text-white text-decoration-none mx-3 small fw-semibold text-uppercase sub-header">Campus Life</a>



    @if(session()->get('is_admin'))
        <a href="{{ route('admin.dashboard') }}"
           class="text-white text-decoration-none mx-3 small fw-semibold text-uppercase sub-header">
            Dashboard
        </a>
    @endif

    <!-- ⭐ ADD INQUIRY BUTTON -->
    {{-- <a href="{{ route('student.inquiry') }}"
       class="btn btn-sm btn-success mx-3 fw-semibold text-uppercase">
        Add Inquiry
    </a> --}}

    @if(session()->has('student_id'))
        <a href="{{ route('student.inquiry') }}"
        class="btn btn-sm btn-success mx-3 fw-semibold text-uppercase">
            Add Inquiry
        </a>
    @else
        <button type="button"
                class="btn btn-sm btn-success mx-3 fw-semibold text-uppercase"
                data-bs-toggle="modal"
                data-bs-target="#authModal">
            Add Inquiry
        </button>
    @endif

    <div class="d-inline-block float-end me-3">

    @if(session()->has('student_id'))

        @php
            $name = session('student_name');
            $initial = strtoupper(substr($name, 0, 1));
        @endphp

        <div class="dropdown d-inline-block">

            <!-- 🔵 Circle Avatar -->
            <a class="d-flex align-items-center justify-content-center text-white fw-bold rounded-circle bg-primary text-decoration-none dropdown-toggle"
               href="#"
               role="button"
               data-bs-toggle="dropdown"
               style="width:40px; height:40px; font-size:16px;">
                {{ $initial }}
            </a>

            <!-- Dropdown -->
            <ul class="dropdown-menu dropdown-menu-end">

                <li class="dropdown-item-text">
                    <small class="text-muted">
                        {{ $name }}
                    </small>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-danger" href="{{ route('student.logout') }}">
                        Logout
                    </a>
                </li>

            </ul>
        </div>

    @else
        <button class="btn btn-sm btn-light fw-semibold"
                data-bs-toggle="modal"
                data-bs-target="#authModal">
            Login
        </button>
    @endif

</div>


</nav>

<!-- ================= OFFICE SECTOR — THIN STRIP ================= -->
<div class="light-yellow text-center">
    <a class="text-white text-decoration-none mx-2 office-link" href="{{route('officeofrector')}}">Office of Rector</a>
    <a class="text-white text-decoration-none mx-2 office-link" href="{{route('student')}}">Students</a>
    <a class="text-white text-decoration-none mx-2 office-link" href="{{route('alumni')}}">Alumni</a>
    <a class="text-white text-decoration-none mx-2 office-link" href="{{route('job')}}">Jobs</a>
    <a class="text-white text-decoration-none mx-2 office-link" href="{{route('download')}}">Downloads</a>
</div>


<!-- Modal -->
<div class="modal fade" id="authModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 text-center">

            <h4 class="mb-3">Login Required</h4>

            <p>Please login or create account first.</p>

            <div class="d-flex justify-content-center gap-3">

                <a href="/login" class="btn btn-success">
                    Login
                </a>

                <a href="/register" class="btn btn-outline-success">
                    Sign Up
                </a>

            </div>

        </div>
    </div>
</div>
