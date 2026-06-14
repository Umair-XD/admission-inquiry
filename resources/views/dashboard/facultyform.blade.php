@extends('dashboard.layouts.app')
@section('title', 'Add Faculty')
@section('page-title', 'Add Faculty')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i>Faculty Form</h4>
        <small class="text-muted">Fill in the details below</small>
    </div>
    <a href="{{ route('faculty') }}" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form class="row g-4" method="POST" action="{{ route('facultyform.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Profile picture upload --}}
            <div class="col-12 text-center">
                <input type="file" name="profile_picture" id="picture" accept="image/*" style="display:none;"
                       onchange="previewImage(event)">
                <div onclick="document.getElementById('picture').click();"
                     class="mx-auto border border-2 border-primary border-dashed rounded-3 d-flex align-items-center justify-content-center overflow-hidden"
                     style="width:120px;height:120px;cursor:pointer;">
                    <img id="preview" src="" alt="Preview"
                         style="width:100%;height:100%;object-fit:cover;display:none;">
                    <span id="placeholderText" class="text-primary small fw-semibold">
                        <i class="fa-solid fa-camera d-block fs-3 mb-1"></i> Upload
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">First Name</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                       name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name" required>
                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Last Name</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                       name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name" required>
                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Personal Email</label>
                <input type="email" class="form-control @error('personal_email') is-invalid @enderror"
                       name="personal_email" value="{{ old('personal_email') }}" placeholder="example@gmail.com" required>
                @error('personal_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Official Email <span class="text-danger">*</span>
                    <small class="text-muted fw-normal">(used for admin login)</small>
                </label>
                <input type="email" class="form-control @error('official_email') is-invalid @enderror"
                       name="official_email" value="{{ old('official_email') }}" placeholder="example@nfc.edu.pk" required>
                @error('official_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="Min 8 characters" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control"
                       name="password_confirmation" placeholder="Repeat password" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Phone</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                       name="phone" value="{{ old('phone') }}" placeholder="03xx-xxxxxxx" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Designation</label>
                <input type="text" class="form-control @error('designation') is-invalid @enderror"
                       name="designation" value="{{ old('designation') }}" placeholder="e.g. Lecturer" required>
                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Last Degree</label>
                <input type="text" class="form-control @error('degree') is-invalid @enderror"
                       name="degree" value="{{ old('degree') }}" placeholder="e.g. PhD" required>
                @error('degree')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Experience (Years)</label>
                <input type="number" class="form-control @error('experience') is-invalid @enderror"
                       name="experience" value="{{ old('experience') }}" min="0" placeholder="0" required>
                @error('experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Specialization</label>
                <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                       name="specialization" value="{{ old('specialization') }}" placeholder="e.g. Machine Learning" required>
                @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 text-end">
                <a href="{{ route('faculty') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-paper-plane me-1"></i> Submit
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholderText');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
