@php
    $statusMap = [
        'active'   => ['color' => 'warning',   'label' => 'In Process'],
        'inactive' => ['color' => 'success',   'label' => 'Admitted'],
        'archive'  => ['color' => 'secondary', 'label' => 'Archived'],
    ];
    $sm     = $statusMap[$inquiry->status] ?? ['color' => 'secondary', 'label' => ucfirst($inquiry->status)];
    $matric = $inquiry->degrees->where('degree_id', 1)->first();
    $inter  = $inquiry->degrees->where('degree_id', 2)->first();
    $bs     = $inquiry->degrees->where('degree_id', 3)->first();
    $ms     = $inquiry->degrees->where('degree_id', 4)->first();
@endphp

<div class="modal fade" id="viewInquiryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h6 class="modal-title fw-semibold mb-0">{{ $inquiry->name }}</h6>
                    <span class="badge rounded-pill bg-{{ $sm['color'] }}-subtle text-{{ $sm['color'] }}" style="font-size:.7rem;">{{ $sm['label'] }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="max-height:70vh;overflow-y:auto;">

                {{-- Personal Info --}}
                <p class="text-uppercase fw-semibold text-muted mb-2" style="font-size:.7rem;letter-spacing:.06em;">Personal Information</p>
                <div class="row g-2 mb-3">
                    <div class="col-md-4 col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">CNIC</div>
                            <div class="fw-medium small">{{ $inquiry->cnic ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Phone</div>
                            <div class="fw-medium small">{{ $inquiry->phone ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Age</div>
                            <div class="fw-medium small">{{ $inquiry->age ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Department</div>
                            <div class="fw-medium small">{{ $inquiry->department?->name ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Course</div>
                            <div class="fw-medium small">{{ $inquiry->course?->name ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Submitted</div>
                            <div class="fw-medium small">{{ $inquiry->created_at->format('d M Y, h:i A') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Last Updated</div>
                            <div class="fw-medium small">{{ $inquiry->updated_at->format('d M Y, h:i A') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Academic Records --}}
                <p class="text-uppercase fw-semibold text-muted mb-2" style="font-size:.7rem;letter-spacing:.06em;">Academic Records</p>

                @if($matric)
                <div class="border rounded p-2 mb-2">
                    <div class="fw-semibold small text-primary mb-1"><i class="fa-solid fa-circle-dot me-1"></i>Matric</div>
                    <div class="d-flex gap-3">
                        <span class="small"><span class="text-muted">Obtained:</span> <strong>{{ $matric->obtained ?? '—' }}</strong></span>
                        <span class="small"><span class="text-muted">Total:</span> <strong>{{ $matric->total ?? '—' }}</strong></span>
                    </div>
                </div>
                @endif

                @if($inter)
                <div class="border rounded p-2 mb-2">
                    <div class="fw-semibold small text-primary mb-1"><i class="fa-solid fa-circle-dot me-1"></i>Intermediate</div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="small text-muted fw-semibold">Part 1</div>
                            <div class="d-flex gap-3">
                                <span class="small"><span class="text-muted">Obtained:</span> <strong>{{ $inter->part1_obtained ?? '—' }}</strong></span>
                                <span class="small"><span class="text-muted">Total:</span> <strong>{{ $inter->part1_total ?? '—' }}</strong></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted fw-semibold">Part 2</div>
                            <div class="d-flex gap-3">
                                <span class="small"><span class="text-muted">Obtained:</span> <strong>{{ $inter->part2_obtained ?? '—' }}</strong></span>
                                <span class="small"><span class="text-muted">Total:</span> <strong>{{ $inter->part2_total ?? '—' }}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($bs)
                <div class="border rounded p-2 mb-2">
                    <div class="fw-semibold small text-primary mb-1"><i class="fa-solid fa-circle-dot me-1"></i>BS / Bachelors</div>
                    <div class="d-flex gap-3">
                        <span class="small"><span class="text-muted">Obtained:</span> <strong>{{ $bs->obtained ?? '—' }}</strong></span>
                        <span class="small"><span class="text-muted">Total:</span> <strong>{{ $bs->total ?? '—' }}</strong></span>
                    </div>
                </div>
                @endif

                @if($ms)
                <div class="border rounded p-2 mb-2">
                    <div class="fw-semibold small text-primary mb-1"><i class="fa-solid fa-circle-dot me-1"></i>MS / Masters</div>
                    <div class="d-flex gap-3">
                        <span class="small"><span class="text-muted">Obtained:</span> <strong>{{ $ms->obtained ?? '—' }}</strong></span>
                        <span class="small"><span class="text-muted">Total:</span> <strong>{{ $ms->total ?? '—' }}</strong></span>
                    </div>
                </div>
                @endif

                @if($inquiry->entry_obtained)
                <div class="border rounded p-2 mb-2">
                    <div class="fw-semibold small text-primary mb-1"><i class="fa-solid fa-circle-dot me-1"></i>Entry Test</div>
                    <div class="d-flex gap-3">
                        <span class="small"><span class="text-muted">Obtained:</span> <strong>{{ $inquiry->entry_obtained }}</strong></span>
                        <span class="small"><span class="text-muted">Total:</span> <strong>{{ $inquiry->entry_total ?? '—' }}</strong></span>
                    </div>
                </div>
                @endif

                @if(!$matric && !$inter && !$bs && !$ms && !$inquiry->entry_obtained)
                <p class="text-muted small">No academic records entered.</p>
                @endif

                {{-- Comments --}}
                @if($inquiry->comments->count())
                <p class="text-uppercase fw-semibold text-muted mb-2 mt-3" style="font-size:.7rem;letter-spacing:.06em;">
                    Comments <span class="badge bg-secondary-subtle text-secondary rounded-pill">{{ $inquiry->comments->count() }}</span>
                </p>
                <div style="max-height:160px;overflow-y:auto;">
                    @foreach($inquiry->comments as $comment)
                    <div class="d-flex gap-2 mb-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:30px;height:30px;font-size:.75rem;">
                            {{ strtoupper(substr($comment->user->name ?? '?', 0, 1)) }}
                        </div>
                        <div class="bg-light rounded p-2 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold" style="font-size:.78rem;">{{ $comment->user->name ?? 'Unknown' }}</span>
                                <span class="text-muted" style="font-size:.7rem;">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mb-0 small">{{ $comment->body }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
