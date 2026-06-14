
<!-- =============== MAIN HEADER (NOW SAME SIZE AS FOOTER) =============== -->
<div class="header-bg">
    <div class="d-flex justify-content-center align-items-center gap-3 py-2">
        <img src="{{ asset('logo.png') }}" height="70">

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



    @if(auth()->check() && auth()->user()->isSuperAdmin())
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
            $cnic = session('student_cnic') ?? \App\Models\Student::find(session('student_id'))?->cnic;
            $initial = strtoupper(substr($name, 0, 1));
        @endphp

        <div class="dropdown d-inline-block">

            <!-- 🔵 Circle Avatar -->
            <a class="d-flex align-items-center justify-content-center text-white fw-bold rounded-circle text-decoration-none dropdown-toggle"
               href="#"
               role="button"
               data-bs-toggle="dropdown"
               style="width:40px;height:40px;font-size:16px;background:#e8cc14;color:#012a4a !important;">
                {{ $initial }}
            </a>

            <!-- Dropdown -->
            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item py-2 d-block" href="{{ route('profile') }}" style="line-height:1.3;">
                        <span class="fw-semibold d-block">{{ $name }}</span>
                        <small class="text-muted" style="font-size:.72rem;letter-spacing:.03em;">{{ $cnic }}</small>
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-danger" href="{{ route('student.logout') }}">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
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


<!-- Auth Modal — Login / Register tabs -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header border-0 pb-0">
                <ul class="nav nav-tabs w-100 border-0" id="authTabs">
                    <li class="nav-item flex-fill text-center">
                        <button class="nav-link w-100 fw-semibold {{ session('open_auth_modal') === 'login' || !session('open_auth_modal') ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#loginTab">
                            Login
                        </button>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <button class="nav-link w-100 fw-semibold {{ session('open_auth_modal') === 'register' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#registerTab">
                            Register
                        </button>
                    </li>
                </ul>
                <button type="button" class="btn-close ms-2 mb-2" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body pt-2">

                @if($errors->any())
                    <div class="alert alert-danger alert-sm py-2 small">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-sm py-2 small">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="tab-content">

                    {{-- ── LOGIN TAB ── --}}
                    <div class="tab-pane fade {{ session('open_auth_modal') === 'register' ? '' : 'show active' }}" id="loginTab">
                        <form method="POST" action="{{ url('/student/login') }}" class="d-grid gap-3 mt-2">
                            @csrf
                            <div>
                                <label class="form-label fw-semibold small">CNIC</label>
                                <input type="text" name="cnic" id="loginCnic"
                                       class="form-control"
                                       placeholder="xxxxx-xxxxxxx-x"
                                       value="{{ old('cnic') }}"
                                       required>
                            </div>
                            <div>
                                <label class="form-label fw-semibold small">Password</label>
                                <input type="password" name="password"
                                       class="form-control"
                                       placeholder="••••••••"
                                       required>
                            </div>
                            <button type="submit" class="btn btn-success fw-semibold">
                                Login
                            </button>
                            <p class="text-center small text-muted mb-0">
                                No account?
                                <a href="#" class="text-success fw-semibold text-decoration-none"
                                   onclick="document.querySelector('[data-bs-target=\'#registerTab\']').click(); return false;">
                                    Register here
                                </a>
                            </p>
                        </form>
                    </div>

                    {{-- ── REGISTER TAB ── --}}
                    <div class="tab-pane fade {{ session('open_auth_modal') === 'register' ? 'show active' : '' }}" id="registerTab">
                        <form method="POST" action="{{ url('/student/register') }}" class="d-grid gap-3 mt-2">
                            @csrf
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Full Name</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Enter full name"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">CNIC</label>
                                    <input type="text" name="cnic" id="modalCnic" class="form-control"
                                           placeholder="xxxxx-xxxxxxx-x"
                                           value="{{ old('cnic') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Mobile</label>
                                    <input type="text" name="mobile" id="modalMobile" class="form-control"
                                           placeholder="03XXXXXXXXX"
                                           value="{{ old('mobile') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">Age</label>
                                    <input type="number" name="age" class="form-control"
                                           placeholder="Age" min="1" max="120"
                                           value="{{ old('age') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Address</label>
                                    <textarea name="address" rows="2" class="form-control"
                                              placeholder="Enter address" required>{{ old('address') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Password</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="Min 8 characters" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="Repeat password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success fw-semibold">
                                Create Account
                            </button>
                            <p class="text-center small text-muted mb-0">
                                Already registered?
                                <a href="#" class="text-success fw-semibold text-decoration-none"
                                   onclick="document.querySelector('[data-bs-target=\'#loginTab\']').click(); return false;">
                                    Login here
                                </a>
                            </p>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
