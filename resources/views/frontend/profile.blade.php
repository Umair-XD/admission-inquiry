@extends('frontend.layouts.app')
@section('title', 'My Profile')

@section('content')

@php
    $student = null;
    if (session()->has('student_id')) {
        $student = \App\Models\Student::find(session('student_id'));
    }
@endphp

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">

            @if(!$student)
                <div class="card shadow-sm rounded-4 p-4 text-center">
                    <i class="fa-solid fa-lock fa-3x text-muted mb-3"></i>
                    <h5 class="fw-bold">Not logged in</h5>
                    <p class="text-muted small">Please login to view your profile.</p>
                    <button class="btn btn-success mx-auto px-4"
                            data-bs-toggle="modal" data-bs-target="#authModal">
                        Login
                    </button>
                </div>
            @else
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-4 p-sm-5">

                    {{-- Avatar --}}
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold mx-auto mb-2"
                             style="width:80px;height:80px;font-size:2rem;">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <h5 class="fw-bold mb-0">{{ $student->name }}</h5>
                        <span class="badge bg-success-subtle text-success mt-1">Active Student</span>
                    </div>

                    {{-- Info --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted fw-semibold">Full Name</label>
                            <input type="text" class="form-control" value="{{ $student->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted fw-semibold">CNIC</label>
                            <input type="text" class="form-control" value="{{ $student->cnic }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted fw-semibold">Mobile</label>
                            <input type="text" class="form-control" value="{{ $student->mobile }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted fw-semibold">Age</label>
                            <input type="text" class="form-control" value="{{ $student->age }}" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label small text-muted fw-semibold">Address</label>
                            <textarea class="form-control" rows="2" readonly>{{ $student->address }}</textarea>
                        </div>
                    </div>

                    {{-- Academic marks if present --}}
                    @if($student->matric_marks || $student->part1_marks || $student->entry_test_marks)
                    <hr class="my-4">
                    <h6 class="fw-semibold text-muted mb-3">Academic Record</h6>
                    <div class="row g-3 text-center">
                        @if($student->matric_marks)
                        <div class="col-6 col-md-3">
                            <div class="border rounded p-2">
                                <div class="fw-bold text-dark">{{ $student->matric_marks }}</div>
                                <small class="text-muted">Matric</small>
                            </div>
                        </div>
                        @endif
                        @if($student->part1_marks)
                        <div class="col-6 col-md-3">
                            <div class="border rounded p-2">
                                <div class="fw-bold text-dark">{{ $student->part1_marks }}</div>
                                <small class="text-muted">Part 1</small>
                            </div>
                        </div>
                        @endif
                        @if($student->part2_marks)
                        <div class="col-6 col-md-3">
                            <div class="border rounded p-2">
                                <div class="fw-bold text-dark">{{ $student->part2_marks }}</div>
                                <small class="text-muted">Part 2</small>
                            </div>
                        </div>
                        @endif
                        @if($student->entry_test_marks)
                        <div class="col-6 col-md-3">
                            <div class="border rounded p-2">
                                <div class="fw-bold text-dark">{{ $student->entry_test_marks }}</div>
                                <small class="text-muted">Entry Test</small>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="d-grid mt-4">
                        <a href="{{ route('student.logout') }}" class="btn btn-outline-danger">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                        </a>
                    </div>

                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
