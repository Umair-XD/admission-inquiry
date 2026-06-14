<div class="modal fade" id="viewStudentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h6 class="modal-title fw-semibold mb-0">{{ $student->name }}</h6>
                    <small class="text-muted">Registered {{ $student->created_at->format('d M Y') }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <p class="text-uppercase fw-semibold text-muted mb-2" style="font-size:.7rem;letter-spacing:.06em;">Personal Information</p>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">CNIC</div>
                            <div class="fw-medium small">{{ $student->cnic ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Mobile</div>
                            <div class="fw-medium small">{{ $student->mobile ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Age</div>
                            <div class="fw-medium small">{{ $student->age ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Address</div>
                            <div class="fw-medium small">{{ $student->address ?: '—' }}</div>
                        </div>
                    </div>
                </div>

                <p class="text-uppercase fw-semibold text-muted mb-2" style="font-size:.7rem;letter-spacing:.06em;">Academic Marks</p>
                @php
                    $marks = [
                        'Matric'     => $student->matric_marks,
                        'Part 1'     => $student->part1_marks,
                        'Part 2'     => $student->part2_marks,
                        'Entry Test' => $student->entry_test_marks,
                    ];
                    $hasAny = collect($marks)->filter()->isNotEmpty();
                @endphp
                @if($hasAny)
                <div class="row g-2">
                    @foreach($marks as $label => $value)
                        @if($value !== null && $value !== '')
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded p-2 text-center">
                                <div class="text-muted" style="font-size:.7rem;">{{ $label }}</div>
                                <div class="fw-bold">{{ $value }}</div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                @else
                <p class="text-muted small mb-0">No academic data entered.</p>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
