<div class="modal fade" id="editInquiryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('inquiry.update', $inquiry->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title fw-semibold">Edit Inquiry — {{ $inquiry->name }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ $inquiry->name }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Age</label>
                            <input type="number" name="age" class="form-control form-control-sm" value="{{ $inquiry->age }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-sm" value="{{ $inquiry->phone }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">CNIC</label>
                            <input type="text" name="cnic" class="form-control form-control-sm" value="{{ $inquiry->cnic }}" required>
                        </div>

                        <div class="col-12">
                            <hr class="my-1">
                            <small class="text-muted fw-semibold text-uppercase" style="font-size:.7rem;letter-spacing:.05em;">Academic Records</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Matric <span class="text-muted fw-normal">(Obtained / Total)</span></label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" name="degrees[1][obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $matric?->obtained }}"></div>
                                <div class="col-6"><input type="number" name="degrees[1][total]" class="form-control form-control-sm" placeholder="Total" value="{{ $matric?->total }}"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Inter Part 1 <span class="text-muted fw-normal">(Obtained / Total)</span></label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" name="degrees[2][part1_obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $inter?->part1_obtained }}"></div>
                                <div class="col-6"><input type="number" name="degrees[2][part1_total]" class="form-control form-control-sm" placeholder="Total" value="{{ $inter?->part1_total }}"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Inter Part 2 <span class="text-muted fw-normal">(Obtained / Total)</span></label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" name="degrees[2][part2_obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $inter?->part2_obtained }}"></div>
                                <div class="col-6"><input type="number" name="degrees[2][part2_total]" class="form-control form-control-sm" placeholder="Total" value="{{ $inter?->part2_total }}"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">BS / Bachelors <span class="text-muted fw-normal">(Obtained / Total)</span></label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" name="degrees[3][obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $bs?->obtained }}"></div>
                                <div class="col-6"><input type="number" name="degrees[3][total]" class="form-control form-control-sm" placeholder="Total" value="{{ $bs?->total }}"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">MS / Masters <span class="text-muted fw-normal">(Obtained / Total)</span></label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" name="degrees[4][obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $ms?->obtained }}"></div>
                                <div class="col-6"><input type="number" name="degrees[4][total]" class="form-control form-control-sm" placeholder="Total" value="{{ $ms?->total }}"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Entry Test <span class="text-muted fw-normal">(Obtained / Total)</span></label>
                            <div class="row g-2">
                                <div class="col-6"><input type="number" name="entry_obtained" class="form-control form-control-sm" placeholder="Obtained" value="{{ $inquiry->entry_obtained }}"></div>
                                <div class="col-6"><input type="number" name="entry_total" class="form-control form-control-sm" placeholder="Total" value="{{ $inquiry->entry_total }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
