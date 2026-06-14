<div class="modal fade" id="editInquiryModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('inquiry.update', $inquiry->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title fw-semibold"><i class="fa-solid fa-file-pen me-2"></i>Edit Inquiry</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-3" style="max-height:70vh;overflow-y:auto;">

                    {{-- Personal Information --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa-solid fa-user me-2 text-primary"></i>Personal Information
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm" value="{{ $inquiry->name }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold small">Age <span class="text-danger">*</span></label>
                                    <input type="number" name="age" class="form-control form-control-sm" value="{{ $inquiry->age }}" min="1" max="100" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold small">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control form-control-sm" value="{{ $inquiry->phone }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">CNIC <span class="text-danger">*</span></label>
                                    <input type="text" name="cnic" class="form-control form-control-sm" value="{{ $inquiry->cnic }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold small">Department <span class="text-danger">*</span></label>
                                    <select name="department_id" id="editDepartment" class="form-select form-select-sm s2-edit" required>
                                        <option value="" disabled>Select Department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}" {{ $inquiry->department_id == $dept->id ? 'selected' : '' }}>
                                                {{ $dept->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold small">Course</label>
                                    <select name="course_id" id="editCourse" class="form-select form-select-sm s2-edit">
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Academic Records --}}
                    <div class="card mb-0">
                        <div class="card-header">
                            <i class="fa-solid fa-graduation-cap me-2 text-primary"></i>Academic Records
                            <small class="text-muted fw-normal ms-2">Select a degree to add</small>
                        </div>
                        <div class="card-body">

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">Add Degree</label>
                                    <select id="editDegreeSelector" class="form-select form-select-sm s2-edit">
                                        <option value="" disabled selected>Select Degree</option>
                                        @foreach($degrees as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Matric --}}
                            <div class="degree-box border rounded p-3 mb-3 bg-light {{ $matric ? '' : 'd-none' }}" id="edit-degree-1">
                                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>Matric Marks</div>
                                <div class="row g-2">
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Obtained</label>
                                        <input type="number" name="degrees[1][obtained]" class="form-control form-control-sm" step="0.01" min="0" placeholder="e.g. 850" value="{{ $matric?->obtained }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Total</label>
                                        <input type="number" name="degrees[1][total]" class="form-control form-control-sm" step="0.01" min="0" placeholder="e.g. 1100" value="{{ $matric?->total }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Intermediate --}}
                            <div class="degree-box border rounded p-3 mb-3 bg-light {{ $inter ? '' : 'd-none' }}" id="edit-degree-2">
                                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>Intermediate</div>
                                <div class="row g-2">
                                    <div class="col-12"><small class="text-muted fw-semibold">Part 1</small></div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Obtained</label>
                                        <input type="number" name="degrees[2][part1_obtained]" class="form-control form-control-sm" step="0.01" min="0" placeholder="Obtained" value="{{ $inter?->part1_obtained }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Total</label>
                                        <input type="number" name="degrees[2][part1_total]" class="form-control form-control-sm" step="0.01" min="0" placeholder="Total" value="{{ $inter?->part1_total }}">
                                    </div>
                                    <div class="col-12"><small class="text-muted fw-semibold">Part 2</small></div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Obtained</label>
                                        <input type="number" name="degrees[2][part2_obtained]" class="form-control form-control-sm" step="0.01" min="0" placeholder="Obtained" value="{{ $inter?->part2_obtained }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Total</label>
                                        <input type="number" name="degrees[2][part2_total]" class="form-control form-control-sm" step="0.01" min="0" placeholder="Total" value="{{ $inter?->part2_total }}">
                                    </div>
                                </div>
                            </div>

                            {{-- BS --}}
                            <div class="degree-box border rounded p-3 mb-3 bg-light {{ $bs ? '' : 'd-none' }}" id="edit-degree-3">
                                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>BS / Bachelors</div>
                                <div class="row g-2">
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Obtained</label>
                                        <input type="number" name="degrees[3][obtained]" class="form-control form-control-sm" step="0.01" min="0" placeholder="e.g. 3.50" value="{{ $bs?->obtained }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Total</label>
                                        <input type="number" name="degrees[3][total]" class="form-control form-control-sm" step="0.01" min="0" placeholder="e.g. 4.00" value="{{ $bs?->total }}">
                                    </div>
                                </div>
                            </div>

                            {{-- MS --}}
                            <div class="degree-box border rounded p-3 mb-3 bg-light {{ $ms ? '' : 'd-none' }}" id="edit-degree-4">
                                <div class="fw-semibold small mb-2 text-primary"><i class="fa-solid fa-circle-dot me-1"></i>MS / Masters</div>
                                <div class="row g-2">
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Obtained</label>
                                        <input type="number" name="degrees[4][obtained]" class="form-control form-control-sm" step="0.01" min="0" placeholder="e.g. 3.70" value="{{ $ms?->obtained }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Total</label>
                                        <input type="number" name="degrees[4][total]" class="form-control form-control-sm" step="0.01" min="0" placeholder="e.g. 4.00" value="{{ $ms?->total }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Entry Test --}}
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <input type="checkbox" id="editEntryCheck" class="form-check-input" {{ $inquiry->entry_obtained ? 'checked' : '' }}>
                                    <label for="editEntryCheck" class="form-label fw-semibold small mb-0 text-primary">
                                        <i class="fa-solid fa-circle-dot me-1"></i>Entry Test
                                    </label>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Obtained</label>
                                        <input type="number" id="editEntryObt" name="entry_obtained" class="form-control form-control-sm" step="0.01" min="0" placeholder="Obtained" value="{{ $inquiry->entry_obtained }}" {{ $inquiry->entry_obtained ? '' : 'disabled' }}>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small">Total</label>
                                        <input type="number" id="editEntryTotal" name="entry_total" class="form-control form-control-sm" step="0.01" min="0" placeholder="Total" value="{{ $inquiry->entry_total }}" {{ $inquiry->entry_obtained ? '' : 'disabled' }}>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
(function () {
    var courseUrl = '{{ route("courses.by.department", ":id") }}';
    var existingCourseId = {{ $inquiry->course_id ?? 'null' }};

    // Init Select2 scoped to modal
    $('.s2-edit').select2({ theme: 'bootstrap-5', width: '100%', dropdownParent: $('#editInquiryModal') });

    // Load courses for existing department on open
    var deptId = {{ $inquiry->department_id ?? 'null' }};
    if (deptId) {
        $.getJSON(courseUrl.replace(':id', deptId), function (data) {
            var $c = $('#editCourse').empty().append('<option value="">Select Course</option>');
            $.each(data, function (i, c) {
                $c.append(new Option(c.name, c.id, false, c.id == existingCourseId));
            });
            $c.trigger('change');
        });
    }

    // Reload courses on department change
    $('#editDepartment').on('change', function () {
        var $c = $('#editCourse').empty().append('<option value="">Loading...</option>').trigger('change');
        $.getJSON(courseUrl.replace(':id', this.value), function (data) {
            $c.empty().append('<option value="">Select Course</option>');
            $.each(data, function (i, c) { $c.append(new Option(c.name, c.id)); });
            $c.trigger('change');
        });
    });

    // Degree selector → show that degree box, reset selector
    $('#editDegreeSelector').on('change', function () {
        var val = $(this).val();
        if (val) {
            $('#edit-degree-' + val).removeClass('d-none');
            $(this).val(null).trigger('change');
        }
    });

    // Entry test toggle
    $('#editEntryCheck').on('change', function () {
        $('#editEntryObt, #editEntryTotal').prop('disabled', !this.checked);
    });
})();
</script>
