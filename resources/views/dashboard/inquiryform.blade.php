@extends('dashboard.layouts.app')
@section('title', 'Add Inquiry')
@section('page-title', 'Add Inquiry')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-file-lines me-2 text-primary"></i>Add Inquiry</h4>
        <small class="text-muted">Fill in the applicant's details below</small>
    </div>
    <a href="{{ route('inquires') }}" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
    </a>
</div>

<form method="POST" action="{{ route('inquiryform.store') }}">
@csrf

{{-- ── Personal Info ── --}}
<div class="card mb-3">
    <div class="card-header">
        <i class="fa-solid fa-user me-2 text-primary"></i>Personal Information
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Enter full name" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Age <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                       value="{{ old('age') }}" placeholder="Age" min="1" max="100" required>
                @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                <input type="text" id="phone" name="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone') }}" placeholder="03xx-xxxxxxx" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">CNIC <span class="text-danger">*</span></label>
                <input type="text" id="cnic" name="cnic"
                       class="form-control @error('cnic') is-invalid @enderror"
                       value="{{ old('cnic') }}" placeholder="xxxxx-xxxxxxx-x" required>
                @error('cnic')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                <select name="department_id" id="department"
                        class="form-select select2 @error('department_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Select Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Course</label>
                <select name="course_id" id="course"
                        class="form-select select2 @error('course_id') is-invalid @enderror">
                    <option value="">— Select Course —</option>
                </select>
                @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

{{-- ── Academic Records ── --}}
<div class="card mb-3">
    <div class="card-header">
        <i class="fa-solid fa-graduation-cap me-2 text-primary"></i>Academic Records
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
                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>Matric Marks</div>
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
                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>Intermediate</div>
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
                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>BS / Bachelors</div>
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
                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>MS / Masters</div>
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
                <label for="entryCheck" class="form-label fw-semibold small mb-0 text-primary">
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
    <a href="{{ route('inquires') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary px-4">
        <i class="fa-solid fa-paper-plane me-1"></i> Submit Inquiry
    </button>
</div>

</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Degree selector
    document.getElementById('degree').addEventListener('change', function () {
        document.querySelectorAll('.degree-box').forEach(b => b.classList.add('d-none'));
        const box = document.getElementById('degree-' + this.value);
        if (box) box.classList.remove('d-none');
    });

    // Course loader
    document.getElementById('department').addEventListener('change', function () {
        var courseSelect = $('#course');
        courseSelect.empty().append('<option>Loading...</option>').trigger('change');
        fetch("{{ route('courses.by.department', ':id') }}".replace(':id', this.value))
            .then(r => r.json())
            .then(data => {
                courseSelect.empty();
                if (!data.length) {
                    courseSelect.append('<option value="" disabled selected>No courses available</option>');
                } else {
                    courseSelect.append('<option value="" disabled selected>Select Course</option>');
                    data.forEach(c => courseSelect.append(new Option(c.name, c.id)));
                }
                courseSelect.trigger('change'); // refresh Select2
            });
    });

    // Entry test toggle
    document.getElementById('entryCheck').addEventListener('change', function () {
        document.getElementById('entryObt').disabled   = !this.checked;
        document.getElementById('entryTotal').disabled = !this.checked;
    });

    // CNIC formatter
    document.getElementById('cnic').addEventListener('input', function () {
        let v = this.value.replace(/\D/g,'').slice(0,13);
        if (v.length > 12)     v = v.slice(0,5)+'-'+v.slice(5,12)+'-'+v.slice(12);
        else if (v.length > 5) v = v.slice(0,5)+'-'+v.slice(5);
        this.value = v;
    });

    // Phone formatter
    document.getElementById('phone').addEventListener('input', function () {
        let v = this.value.replace(/\D/g,'').slice(0,11);
        if (v.length > 4) v = v.slice(0,4)+'-'+v.slice(4);
        this.value = v;
    });
});
</script>
@endpush
