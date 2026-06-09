@extends('dashboard.layouts.app')
@section('title', 'Departments')
@section('page-title', 'Departments')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-building-columns me-2 text-primary"></i>Departments</h4>
        <small class="text-muted">Manage departments and their courses</small>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeptModal">
        <i class="fa-solid fa-plus me-1"></i> Add Department
    </button>
</div>

@if($departments->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="fa-solid fa-building-columns fa-3x mb-3 opacity-25"></i>
            <p class="mb-0">No departments yet. Create one to get started.</p>
        </div>
    </div>
@else
    <div class="row g-3">
        @foreach($departments as $dept)
        <div class="col-12">
            <div class="card">
                {{-- Department Header --}}
                <div class="card-header d-flex align-items-center justify-content-between py-3"
                     style="cursor:pointer;"
                     data-bs-toggle="collapse"
                     data-bs-target="#deptBody{{ $dept->id }}"
                     aria-expanded="true">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary-subtle text-primary rounded-circle p-2">
                            <i class="fa-solid fa-building-columns"></i>
                        </span>
                        <div>
                            <div class="fw-semibold text-dark">{{ $dept->name }}</div>
                            <small class="text-muted">{{ $dept->courses_count }} {{ Str::plural('course', $dept->courses_count) }}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#editDeptModal{{ $dept->id }}"
                                onclick="event.stopPropagation()">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <form action="{{ route('departments.destroy', $dept) }}" method="POST"
                              onsubmit="confirmDelete(this, 'Delete {{ addslashes($dept->name) }} and all its courses?'); return false;"
                              onclick="event.stopPropagation()">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        <button class="btn btn-sm btn-outline-success"
                                data-bs-toggle="modal"
                                data-bs-target="#addCourseModal{{ $dept->id }}"
                                onclick="event.stopPropagation()">
                            <i class="fa-solid fa-plus"></i> Course
                        </button>
                        <i class="fa-solid fa-chevron-up text-muted collapse-icon" style="transition:transform .2s;font-size:.8rem;"></i>
                    </div>
                </div>

                {{-- Courses Table — NO modals inside --}}
                <div class="collapse show" id="deptBody{{ $dept->id }}">
                    <div class="card-body p-0">
                    @if($dept->courses->isEmpty())
                        <p class="text-muted text-center py-3 mb-0 small">No courses added yet.</p>
                    @else
                        <div class="table-responsive px-3 pt-2 pb-1">
                            <table class="table table-hover align-middle mb-0" id="coursesTable{{ $dept->id }}">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dept->courses as $i => $course)
                                    <tr>
                                        <td class="text-muted small">{{ $i + 1 }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="fa-solid fa-book-open me-1 text-primary"></i>
                                                {{ $course->name }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-secondary me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCourseModal{{ $course->id }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST"
                                                  style="display:inline"
                                                  onsubmit="confirmDelete(this, 'Delete this course?'); return false;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    </div>
                </div>{{-- end collapse --}}
            </div>
        </div>
        @endforeach
    </div>
@endif

{{-- ══════════ ALL MODALS — outside every table ══════════ --}}

{{-- Add Department --}}
<div class="modal fade" id="addDeptModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Add Department</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Department name" required>
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($departments as $dept)

{{-- Edit Department --}}
<div class="modal fade" id="editDeptModal{{ $dept->id }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('departments.update', $dept) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Edit Department</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" value="{{ $dept->name }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Course --}}
<div class="modal fade" id="addCourseModal{{ $dept->id }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('courses.store', $dept) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Add Course ({{ $dept->name }})</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Course name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Course modals for each course in this dept --}}
@foreach($dept->courses as $course)
<div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('courses.update', $course) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Edit Course</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endforeach

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Rotate chevron on collapse toggle
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function (el) {
        const target = document.querySelector(el.dataset.bsTarget);
        if (!target) return;

        target.addEventListener('hide.bs.collapse', function () {
            el.querySelector('.collapse-icon').style.transform = 'rotate(180deg)';
        });
        target.addEventListener('show.bs.collapse', function () {
            el.querySelector('.collapse-icon').style.transform = 'rotate(0deg)';
        });
    });

    // Init DataTables on courses tables
    $('[id^="coursesTable"]').each(function () {
        if (!$.fn.DataTable.isDataTable(this)) {
            $(this).DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                order: [],
                columnDefs: [{ orderable: false, targets: [-1] }],
                language: {
                    search: '',
                    searchPlaceholder: 'Search courses...',
                    emptyTable: 'No courses yet',
                    info: 'Showing _START_–_END_ of _TOTAL_',
                    lengthMenu: 'Show _MENU_'
                }
            });
        }
    });
});
</script>
@endpush
