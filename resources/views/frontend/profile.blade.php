@extends('frontend.layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="fa-solid fa-circle-exclamation me-2"></i>{{ $errors->first() }}
            </div>
            @endif

            <div class="card shadow-sm rounded-4 border-0">

                {{-- Avatar + name header --}}
                <div class="card-header border-0 rounded-top-4 text-center py-4"
                     style="background:linear-gradient(135deg,#012a4a,#013a63);">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center fw-bold mb-2"
                         style="width:72px;height:72px;font-size:2rem;background:#e8cc14;color:#012a4a;">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold text-white mb-0">{{ $student->name }}</h5>
                    <small style="color:#e8cc14;">{{ $student->cnic }}</small>
                </div>

                <div class="card-body p-4">

                    {{-- VIEW MODE --}}
                    <div id="viewMode">
                        <div class="row g-3 mb-4">
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

                        <div class="d-flex gap-2">
                            <button class="btn fw-semibold flex-fill text-white"
                                    style="background:#013a63;" onclick="toggleEdit(true)">
                                <i class="fa-solid fa-pen me-1"></i> Edit Profile
                            </button>
                            <a href="{{ route('student.logout') }}" class="btn btn-outline-danger px-3">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </div>
                    </div>

                    {{-- EDIT MODE --}}
                    <div id="editMode" style="display:none;">
                        <form method="POST" action="{{ route('student.profile.update') }}">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-semibold">Full Name</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name', $student->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted fw-semibold">Mobile</label>
                                    <input type="text" name="mobile" class="form-control"
                                           value="{{ old('mobile', $student->mobile) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted fw-semibold">Age</label>
                                    <input type="number" name="age" class="form-control"
                                           value="{{ old('age', $student->age) }}" min="1" max="120" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted fw-semibold">Address</label>
                                    <textarea name="address" rows="2" class="form-control" required>{{ old('address', $student->address) }}</textarea>
                                </div>
                            </div>

                            <hr class="my-3">
                            <p class="small text-muted mb-2">Leave password blank to keep it unchanged.</p>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted fw-semibold">New Password</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="Min 6 characters">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted fw-semibold">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="Repeat">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn fw-semibold flex-fill text-white"
                                        style="background:#013a63;">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                                </button>
                                <button type="button" class="btn btn-outline-secondary"
                                        onclick="toggleEdit(false)">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function toggleEdit(on) {
    document.getElementById('viewMode').style.display = on ? 'none' : '';
    document.getElementById('editMode').style.display = on ? '' : 'none';
}
@if($errors->any())
document.addEventListener('DOMContentLoaded', function() { toggleEdit(true); });
@endif
</script>
@endsection
