<div class="modal fade" id="editStudentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('student.update', $student) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Edit ({{ $student->name }})</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height:65vh;overflow-y:auto;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Age</label>
                            <input type="number" name="age" class="form-control" value="{{ $student->age }}" min="1" max="100" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Mobile</label>
                            <input type="text" name="mobile" class="form-control" value="{{ $student->mobile }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">CNIC</label>
                            <input type="text" name="cnic" class="form-control" value="{{ $student->cnic }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $student->address }}">
                        </div>

                        <div class="col-12"><hr class="my-1"><p class="fw-semibold small text-muted mb-0">Academic Marks</p></div>

                        <div class="col-md-3">
                            <label class="form-label small">Matric Marks</label>
                            <input type="number" name="matric_marks" class="form-control form-control-sm" value="{{ $student->matric_marks }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Part 1 Marks</label>
                            <input type="number" name="part1_marks" class="form-control form-control-sm" value="{{ $student->part1_marks }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Part 2 Marks</label>
                            <input type="number" name="part2_marks" class="form-control form-control-sm" value="{{ $student->part2_marks }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Entry Test Marks</label>
                            <input type="number" name="entry_test_marks" class="form-control form-control-sm" value="{{ $student->entry_test_marks }}">
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
