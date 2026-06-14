@extends('frontend.layouts.app')
@section('title', 'Add Inquiry')

@section('content')

<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color:#013a63;">
            <i class="fa-solid fa-file-lines me-2" style="color:#e8cc14;"></i>Add Inquiry
        </h4>
        <small class="text-muted">Fill in your application details below</small>
    </div>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
    </a>
</div>

<form method="POST" action="{{ route('inquiryform.student.store') }}">
@csrf

{{-- ── Personal Information ── --}}
<div class="card mb-3 border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold" style="border-left:3px solid #013a63;">
        <i class="fa-solid fa-user me-2" style="color:#013a63;"></i>Personal Information
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control bg-light"
                       value="{{ $student->name ?? '' }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Age</label>
                <input type="number" name="age" class="form-control bg-light"
                       value="{{ $student->age ?? '' }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control bg-light"
                       value="{{ $student->mobile ?? '' }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">CNIC</label>
                <input type="text" name="cnic" class="form-control bg-light"
                       value="{{ $student->cnic ?? '' }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                <select name="department_id" id="department" class="form-select select2" required>
                    <option value="" disabled selected>Select Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Course</label>
                <select name="course_id" id="course" class="form-select select2">
                    <option value="">Select Course</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{-- ── Academic Records ── --}}
<div class="card mb-3 border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold" style="border-left:3px solid #013a63;">
        <i class="fa-solid fa-graduation-cap me-2" style="color:#013a63;"></i>Academic Records
        <small class="text-muted fw-normal ms-2">Select a degree to enter marks</small>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Add Degree</label>
                <select id="degree" class="form-select select2">
                    <option value="" disabled selected>Select Degree</option>
                    @foreach($degrees as $degree)
                        <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="allDegrees" class="mt-3">

            {{-- Matric --}}
            <div class="degree-box d-none border rounded p-3 mb-3 bg-light" id="degree-1">
                <div class="fw-semibold small mb-2" style="color:#013a63;">
                    <i class="fa-solid fa-circle-dot me-1"></i>Matric Marks
                </div>
                <div class="row g-2">
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Obtained</label>
                        <input type="number" name="degrees[1][obtained]" class="form-control form-control-sm" placeholder="e.g. 850">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Total</label>
                        <input type="number" name="degrees[1][total]" class="form-control form-control-sm" placeholder="e.g. 1100">
                    </div>
                </div>
            </div>

            {{-- Intermediate --}}
            <div class="degree-box d-none border rounded p-3 mb-3 bg-light" id="degree-2">
                <div class="fw-semibold small mb-2" style="color:#013a63;">
                    <i class="fa-solid fa-circle-dot me-1"></i>Intermediate
                </div>
                <div class="row g-2">
                    <div class="col-12"><small class="text-muted fw-semibold">Part 1</small></div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Obtained</label>
                        <input type="number" name="degrees[2][part1_obtained]" class="form-control form-control-sm" placeholder="Obtained">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Total</label>
                        <input type="number" name="degrees[2][part1_total]" class="form-control form-control-sm" placeholder="Total">
                    </div>
                    <div class="col-12"><small class="text-muted fw-semibold">Part 2</small></div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Obtained</label>
                        <input type="number" name="degrees[2][part2_obtained]" class="form-control form-control-sm" placeholder="Obtained">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Total</label>
                        <input type="number" name="degrees[2][part2_total]" class="form-control form-control-sm" placeholder="Total">
                    </div>
                </div>
            </div>

            {{-- BS --}}
            <div class="degree-box d-none border rounded p-3 mb-3 bg-light" id="degree-3">
                <div class="fw-semibold small mb-2" style="color:#013a63;">
                    <i class="fa-solid fa-circle-dot me-1"></i>BS / Bachelors
                </div>
                <div class="row g-2">
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Obtained</label>
                        <input type="number" name="degrees[3][obtained]" class="form-control form-control-sm" placeholder="e.g. 3.5 GPA">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Total</label>
                        <input type="number" name="degrees[3][total]" class="form-control form-control-sm" placeholder="e.g. 4.0">
                    </div>
                </div>
            </div>

            {{-- MS --}}
            <div class="degree-box d-none border rounded p-3 mb-3 bg-light" id="degree-4">
                <div class="fw-semibold small mb-2" style="color:#013a63;">
                    <i class="fa-solid fa-circle-dot me-1"></i>MS / Masters
                </div>
                <div class="row g-2">
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Obtained</label>
                        <input type="number" name="degrees[4][obtained]" class="form-control form-control-sm" placeholder="e.g. 3.7 GPA">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label small">Total</label>
                        <input type="number" name="degrees[4][total]" class="form-control form-control-sm" placeholder="e.g. 4.0">
                    </div>
                </div>
            </div>

        </div>

        {{-- Entry Test --}}
        <div class="border rounded p-3 bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
                <input type="checkbox" id="entryCheck" class="form-check-input">
                <label for="entryCheck" class="form-label fw-semibold small mb-0" style="color:#013a63;">
                    <i class="fa-solid fa-circle-dot me-1"></i>Entry Test
                </label>
            </div>
            <div class="row g-2">
                <div class="col-md-3 col-6">
                    <label class="form-label small">Obtained</label>
                    <input type="number" id="entryObt" name="entry_obtained" class="form-control form-control-sm" placeholder="Obtained" disabled>
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label small">Total</label>
                    <input type="number" id="entryTotal" name="entry_total" class="form-control form-control-sm" placeholder="Total" disabled>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ── Submit ── --}}
<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn fw-semibold text-white px-4" style="background:#013a63;">
        <i class="fa-solid fa-paper-plane me-1"></i> Submit Inquiry
    </button>
</div>

</form>

</div>

@push('scripts')
<script>
$(function () {

    // Select2 on all selects
    $('select.select2').select2({ theme: 'bootstrap-5', width: '100%' });

    // Degree selector
    $('#degree').on('change', function () {
        $('.degree-box').addClass('d-none');
        $('#degree-' + this.value).removeClass('d-none');
    });

    // Course loader
    $('#department').on('change', function () {
        var $course = $('#course');
        $course.empty().append('<option>Loading...</option>').trigger('change');
        $.getJSON("{{ route('courses.by.department', ':id') }}".replace(':id', this.value), function (data) {
            $course.empty();
            if (!data.length) {
                $course.append('<option value="">No courses available</option>');
            } else {
                $course.append('<option value="">Select Course</option>');
                $.each(data, function (i, c) {
                    $course.append(new Option(c.name, c.id));
                });
            }
            $course.trigger('change');
        });
    });

    // Entry test toggle
    $('#entryCheck').on('change', function () {
        $('#entryObt, #entryTotal').prop('disabled', !this.checked);
    });

});
</script>
@endpush

@endsection
