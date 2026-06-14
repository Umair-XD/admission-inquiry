<div class="modal fade" id="editFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('faculty.update', $faculty) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Edit ({{ $faculty->first_name }} {{ $faculty->last_name }})</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height:65vh;overflow-y:auto;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $faculty->first_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $faculty->last_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Personal Email</label>
                            <input type="email" name="personal_email" class="form-control" value="{{ $faculty->personal_email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Official Email</label>
                            <input type="email" name="official_email" class="form-control" value="{{ $faculty->official_email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="{{ $faculty->phone }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Designation</label>
                            <input type="text" name="designation" class="form-control" value="{{ $faculty->designation }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Last Degree</label>
                            <input type="text" name="degree" class="form-control" value="{{ $faculty->degree }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Experience (Years)</label>
                            <input type="number" name="experience" class="form-control" value="{{ $faculty->experience }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Specialization</label>
                            <input type="text" name="specialization" class="form-control" value="{{ $faculty->specialization }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Profile Picture
                                <span class="text-muted fw-normal">(leave blank to keep current)</span>
                            </label>
                            @if($faculty->profile_picture)
                                <div class="mb-2">
                                    <img src="{{ asset('faculty_pictures/'.$faculty->profile_picture) }}"
                                         width="60" height="60" class="rounded-circle object-fit-cover border">
                                </div>
                            @endif
                            <input type="file" name="profile_picture" class="form-control form-control-sm" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
