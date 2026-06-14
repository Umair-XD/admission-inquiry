<div class="modal fade" id="viewFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-3">
                    @if($faculty->profile_picture)
                        <img src="{{ asset('faculty_pictures/'.$faculty->profile_picture) }}"
                             width="46" height="46" class="rounded-circle object-fit-cover border flex-shrink-0">
                    @else
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:46px;height:46px;font-size:1rem;">
                            {{ strtoupper(substr($faculty->first_name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h6 class="modal-title fw-semibold mb-0">{{ $faculty->first_name }} {{ $faculty->last_name }}</h6>
                        <small class="text-muted">{{ $faculty->designation }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <p class="text-uppercase fw-semibold text-muted mb-2" style="font-size:.7rem;letter-spacing:.06em;">Contact</p>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Personal Email</div>
                            <div class="fw-medium small text-break">{{ $faculty->personal_email ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Official Email</div>
                            <div class="fw-medium small text-break">{{ $faculty->official_email ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Phone</div>
                            <div class="fw-medium small">{{ $faculty->phone ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Assigned Department</div>
                            <div class="fw-medium small">{{ $faculty->user?->department?->name ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                <p class="text-uppercase fw-semibold text-muted mb-2" style="font-size:.7rem;letter-spacing:.06em;">Qualifications</p>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Last Degree</div>
                            <div class="fw-medium small">{{ $faculty->degree ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Specialization</div>
                            <div class="fw-medium small">{{ $faculty->specialization ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Experience</div>
                            <div class="fw-medium small">{{ $faculty->experience }} year{{ $faculty->experience != 1 ? 's' : '' }}</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
